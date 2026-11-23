<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RuntimeException;

class BannerController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        abort_unless($request->user()?->role === 'admin', 403);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'published_at' => ['required', 'date'],
            'content' => ['required', 'string'],
            'image' => ['required', 'image', 'max:5120'],
        ]);

        $imagePath = $request->file('image')->store('banners', 'public');

        if ($imagePath === false) {
            throw new RuntimeException('Unable to store the uploaded banner image.');
        }

        Banner::create([
            'content' => $validated['content'],
            'image_path' => $imagePath,
            'published_at' => $validated['published_at'],
            'title' => $validated['title'],
        ]);

        return redirect()->route('news.index');
    }

    public function update(Request $request, Banner $banner): RedirectResponse
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
        $previousImagePath = $banner->image_path;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('banners', 'public');

            if ($imagePath === false) {
                throw new RuntimeException('Unable to store the replacement banner image.');
            }

            $attributes['image_path'] = $imagePath;
        }

        if (! $banner->update($attributes)) {
            throw new RuntimeException('Unable to update the banner record.');
        }

        if ($request->hasFile('image')
            && ! Banner::query()->where('image_path', $previousImagePath)->exists()
            && ! News::query()->where('image_path', $previousImagePath)->exists()
            && ! Storage::disk('public')->delete($previousImagePath)) {
            throw new RuntimeException('Unable to remove the replaced banner image.');
        }

        return redirect()->route('news.index');
    }

    public function destroy(Request $request, Banner $banner): RedirectResponse
    {
        abort_unless($request->user()?->role === 'admin', 403);

        if (! $banner->delete()) {
            throw new RuntimeException('Unable to delete the banner record.');
        }

        if (! Banner::query()->where('image_path', $banner->image_path)->exists()
            && ! News::query()->where('image_path', $banner->image_path)->exists()
            && ! Storage::disk('public')->delete($banner->image_path)) {
            throw new RuntimeException('Unable to remove the deleted banner image.');
        }

        return redirect()->route('news.index');
    }
}
