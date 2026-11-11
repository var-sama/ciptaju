<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use RuntimeException;

class NewsController extends Controller
{
    public function index(): View
    {
        $news = News::query()
            ->latest('published_at')
            ->orderBy('id')
            ->get();

        $latestNews = $news->take(3)
            ->map(fn (News $item): array => [
                'url' => route('news.view', $item),
                'image' => Storage::disk('public')->url($item->image_path),
                'title' => $item->title,
                'date' => $item->published_at->format('d/m/Y'),
            ]);

        $banners = Banner::query()->orderBy('id')->get();
        $bannerSlides = $banners->map(fn (Banner $banner): array => [
            'url' => route('news.index'),
            'image' => Storage::disk('public')->url($banner->image_path),
            'title' => $banner->title ?? 'Informasi Sekolah',
            'description' => $banner->content ?? '',
            'date' => $banner->published_at?->format('d/m/Y') ?? '',
        ]);

        return view('news.index', compact('news', 'latestNews', 'banners', 'bannerSlides'));
    }

    public function view(int $id): View
    {
        $news = News::query()->findOrFail($id);

        return view('news.view', compact('news'));
    }

    public function store(Request $request): RedirectResponse
    {
        abort_unless($request->user()?->role === 'admin', 403);
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'published_at' => ['required', 'date'],
            'content' => ['required', 'string'],
            'image' => ['required', 'image', 'max:5120'],
        ]);

        $imagePath = $request->file('image')->store('news', 'public');

        if ($imagePath === false) {
            throw new RuntimeException('Unable to store the uploaded news image.');
        }

        News::create([
            'content' => $validated['content'],
            'image_path' => $imagePath,
            'published_at' => $validated['published_at'],
            'title' => $validated['title'],
        ]);

        return redirect()->route('news.index');
    }

    public function update(Request $request, News $news): RedirectResponse
    {
        abort_unless($request->user()?->role === 'admin', 403);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'published_at' => ['required', 'date'],
            'content' => ['required', 'string'],
            'image' => ['nullable', 'image', 'max:5120'],
        ]);

        $attributes = [
            'title' => $validated['title'],
            'published_at' => $validated['published_at'],
            'content' => $validated['content'],
        ];
        $previousImagePath = $news->image_path;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news', 'public');

            if ($imagePath === false) {
                throw new RuntimeException('Unable to store the uploaded news image.');
            }

            $attributes['image_path'] = $imagePath;
        }

        if (! $news->update($attributes)) {
            throw new RuntimeException('Unable to update the news record.');
        }

        if (isset($attributes['image_path'])
            && ! News::query()->where('image_path', $previousImagePath)->exists()
            && ! Storage::disk('public')->delete($previousImagePath)) {
            throw new RuntimeException('Unable to remove the replaced news image.');
        }

        return redirect()->route('news.index');
    }

    public function destroy(Request $request, News $news): RedirectResponse
    {
        abort_unless($request->user()?->role === 'admin', 403);

        if (! $news->delete()) {
            throw new RuntimeException('Unable to delete the news record.');
        }

        if (! News::query()->where('image_path', $news->image_path)->exists()
            && ! Storage::disk('public')->delete($news->image_path)) {
            throw new RuntimeException('Unable to remove the deleted news image.');
        }

        return redirect()->route('news.index');
    }
}
