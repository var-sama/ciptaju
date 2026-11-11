<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use RuntimeException;

class AchievementController extends Controller
{
    public function index(): View
    {
        $achievements = Achievement::query()
            ->orderByDesc('year')
            ->orderByDesc('published_at')
            ->orderBy('id')
            ->get()
            ->groupBy('year');

        return view('achievements.index', compact('achievements'));
    }

    public function view(Achievement $achievement): View
    {
        return view('achievements.view', compact('achievement'));
    }

    public function store(Request $request): RedirectResponse
    {
        abort_unless($request->user()?->role === 'admin', 403);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'published_at' => ['required', 'date'],
            'year' => ['required', 'integer', 'between:1900,9999'],
            'content' => ['required', 'string'],
            'image' => ['required', 'image', 'max:5120'],
        ]);

        $imagePath = $request->file('image')->store('achievements', 'public');

        if ($imagePath === false) {
            throw new RuntimeException('Unable to store the uploaded achievement image.');
        }

        Achievement::create([
            'content' => $validated['content'],
            'image_path' => $imagePath,
            'published_at' => $validated['published_at'],
            'title' => $validated['title'],
            'year' => $validated['year'],
        ]);

        return redirect()->route('achievements.index');
    }

    public function update(Request $request, Achievement $achievement): RedirectResponse
    {
        abort_unless($request->user()?->role === 'admin', 403);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'published_at' => ['required', 'date'],
            'year' => ['required', 'integer', 'between:1900,9999'],
            'content' => ['required', 'string'],
            'image' => ['nullable', 'image', 'max:5120'],
        ]);

        $attributes = [
            'content' => $validated['content'],
            'published_at' => $validated['published_at'],
            'title' => $validated['title'],
            'year' => $validated['year'],
        ];
        $previousImagePath = $achievement->image_path;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('achievements', 'public');

            if ($imagePath === false) {
                throw new RuntimeException('Unable to store the replacement achievement image.');
            }

            $attributes['image_path'] = $imagePath;
        }

        if (! $achievement->update($attributes)) {
            throw new RuntimeException('Unable to update the achievement record.');
        }

        if ($request->hasFile('image')
            && ! Achievement::query()->where('image_path', $previousImagePath)->exists()
            && ! Storage::disk('public')->delete($previousImagePath)) {
            throw new RuntimeException('Unable to remove the replaced achievement image.');
        }

        return redirect()->route('achievements.index');
    }

    public function destroy(Request $request, Achievement $achievement): RedirectResponse
    {
        abort_unless($request->user()?->role === 'admin', 403);

        $imagePath = $achievement->image_path;

        if (! $achievement->delete()) {
            throw new RuntimeException('Unable to delete the achievement record.');
        }

        if (! Achievement::query()->where('image_path', $imagePath)->exists()
            && ! Storage::disk('public')->delete($imagePath)) {
            throw new RuntimeException('Unable to remove the deleted achievement image.');
        }

        return redirect()->route('achievements.index');
    }
}
