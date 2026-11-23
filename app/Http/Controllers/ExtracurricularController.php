<?php

namespace App\Http\Controllers;

use App\Models\Extracurricular;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use RuntimeException;

class ExtracurricularController extends Controller
{
    public function index(): View
    {
        $extracurriculars = Extracurricular::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $initialExtracurricular = $extracurriculars->firstWhere('is_active', true)
            ?? $extracurriculars->first();

        return view('extracurriculars.index', compact('extracurriculars', 'initialExtracurricular'));
    }

    public function store(Request $request): RedirectResponse
    {
        abort_unless($request->user()?->role === 'admin', 403);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', Rule::unique('extracurriculars', 'name')],
            'description' => ['required', 'string', 'max:1000'],
            'image' => ['required', 'image', 'max:5120'],
        ]);

        $imagePath = $request->file('image')->store('extracurriculars', 'public');

        if ($imagePath === false) {
            throw new RuntimeException('Unable to store the uploaded extracurricular image.');
        }

        Extracurricular::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'image_path' => $imagePath,
            'sort_order' => (int) Extracurricular::query()->max('sort_order') + 1,
        ]);

        return redirect()->route('extracurriculars.index');
    }

    public function update(Request $request, Extracurricular $extracurricular): RedirectResponse
    {
        abort_unless($request->user()?->role === 'admin', 403);

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('extracurriculars', 'name')->ignore($extracurricular->id),
            ],
            'description' => ['required', 'string', 'max:1000'],
            'image' => ['nullable', 'image', 'max:5120'],
        ]);

        $attributes = [
            'name' => $validated['name'],
            'description' => $validated['description'],
        ];
        $previousImagePath = $extracurricular->image_path;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('extracurriculars', 'public');

            if ($imagePath === false) {
                throw new RuntimeException('Unable to store the replacement extracurricular image.');
            }

            $attributes['image_path'] = $imagePath;
        }

        if (! $extracurricular->update($attributes)) {
            throw new RuntimeException('Unable to update the extracurricular record.');
        }

        if (isset($attributes['image_path'])
            && ! Extracurricular::query()->where('image_path', $previousImagePath)->exists()
            && ! Storage::disk('public')->delete($previousImagePath)) {
            throw new RuntimeException('Unable to remove the replaced extracurricular image.');
        }

        return redirect()->route('extracurriculars.index');
    }

    public function destroy(Request $request, Extracurricular $extracurricular): RedirectResponse
    {
        abort_unless($request->user()?->role === 'admin', 403);

        $imagePath = $extracurricular->image_path;

        if (! $extracurricular->delete()) {
            throw new RuntimeException('Unable to delete the extracurricular record.');
        }

        if (! Extracurricular::query()->where('image_path', $imagePath)->exists()
            && Storage::disk('public')->exists($imagePath)
            && ! Storage::disk('public')->delete($imagePath)) {
            throw new RuntimeException('Unable to remove the deleted extracurricular image.');
        }

        return redirect()->route('extracurriculars.index');
    }
}
