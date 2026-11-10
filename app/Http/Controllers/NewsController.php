<?php

namespace App\Http\Controllers;

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
            ->with('author')
            ->where('is_featured', false)
            ->latest('published_at')
            ->orderBy('id')
            ->get();

        $featuredNews = News::query()
            ->where('is_featured', true)
            ->orderBy('published_at')
            ->orderBy('id')
            ->get()
            ->map(fn (News $item): array => [
                'url' => route('news.view', $item),
                'image' => Storage::disk('public')->url($item->image_path),
                'title' => $item->title,
                'date' => $item->published_at->format('d/m/Y'),
            ]);

        return view('news.index', compact('news', 'featuredNews'));
    }

    public function view(int $id): View
    {
        $news = News::query()
            ->with('author')
            ->findOrFail($id);

        return view('news.view', compact('news'));
    }

    public function store(Request $request): RedirectResponse
    {
        abort_unless($request->user()?->role === 'admin', 403);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'category' => ['required', 'string', 'max:100'],
            'published_at' => ['required', 'date'],
            'content' => ['required', 'string'],
            'image' => ['required', 'image', 'max:5120'],
        ]);

        $imagePath = $request->file('image')->store('news', 'public');

        if ($imagePath === false) {
            throw new RuntimeException('Unable to store the uploaded news image.');
        }

        News::create([
            'author_id' => $request->user()->id,
            'category' => $validated['category'],
            'content' => $validated['content'],
            'image_path' => $imagePath,
            'published_at' => $validated['published_at'],
            'title' => $validated['title'],
        ]);

        return redirect()->route('news.index');
    }
}
