<?php

use App\Models\Achievement;
use App\Models\User;
use Database\Seeders\AchievementSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

test('achievement schema stores all page and detail information', function () {
    expect(Schema::getColumnListing('achievements'))->toBe([
        'id',
        'title',
        'published_at',
        'year',
        'image_path',
        'content',
        'created_at',
        'updated_at',
    ]);
});

test('achievement seeder restores every existing achievement and its images idempotently', function () {
    Storage::fake('public');

    $this->seed(AchievementSeeder::class);
    $this->seed(AchievementSeeder::class);

    expect(Achievement::query()->count())->toBe(13);

    Storage::disk('public')->assertExists('achievements/achievement1.png');
    Storage::disk('public')->assertExists('achievements/acheivement2.png');
    Storage::disk('public')->assertExists('achievements/siswaprestasi.jpg');
});

test('achievement index and detail read records from the database', function () {
    Storage::fake('public');
    $achievement = Achievement::create([
        'content' => 'Deskripsi prestasi dari database.',
        'image_path' => 'achievements/record.jpg',
        'published_at' => '2026-11-11',
        'title' => 'Prestasi dari database',
        'year' => 2026,
    ]);

    $this->get(route('achievements.index'))
        ->assertSuccessful()
        ->assertSee('Prestasi dari database')
        ->assertSee(Storage::disk('public')->url($achievement->image_path), false);

    $this->get(route('achievements.view', $achievement))
        ->assertSuccessful()
        ->assertSee('Prestasi dari database')
        ->assertSee('Deskripsi prestasi dari database.')
        ->assertSee('11/11/2026')
        ->assertSee(Storage::disk('public')->url($achievement->image_path), false);
});

test('achievement index keeps admin controls and year carousel with accessible image validation', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $achievement = Achievement::create([
        'content' => 'Deskripsi prestasi.',
        'image_path' => 'achievements/record.jpg',
        'published_at' => '2026-11-11',
        'title' => 'Prestasi 2026',
        'year' => 2026,
    ]);

    $this->actingAs($admin)
        ->get(route('achievements.index'))
        ->assertSuccessful()
        ->assertSee('id="prestasi-form"', false)
        ->assertSee('id="pilih-gambar-prestasi"', false)
        ->assertSee('id="preview-gambar-prestasi"', false)
        ->assertSee('data-year-section="2026"', false)
        ->assertSee('id="prestasi-track-2026"', false)
        ->assertSee('data-update-url="'.route('achievements.update', $achievement).'"', false)
        ->assertSee('action="'.route('achievements.destroy', $achievement).'"', false)
        ->assertSee('onsubmit="return confirm(', false)
        ->assertSee("const imageRequired = idPrestasiDiedit.value === '';", false)
        ->assertSee('const imageMissing = imageRequired && inputGambar.files.length === 0;', false)
        ->assertDontSee('id="prestasi-gambar-input" name="image" type="file" accept="image/*" required', false);
});

test('an admin can create an achievement with an uploaded image', function () {
    Storage::fake('public');
    $admin = User::factory()->create(['role' => 'admin']);

    $this->actingAs($admin)->post(route('achievements.store'), [
        'achievement_form' => '1',
        'title' => 'Juara Olimpiade',
        'published_at' => '2026-11-10',
        'year' => 2026,
        'content' => 'Deskripsi prestasi terbaru.',
        'image' => UploadedFile::fake()->image('olimpiade.jpg'),
    ])->assertRedirect(route('achievements.index'));

    $achievement = Achievement::query()->firstOrFail();
    $this->assertModelExists($achievement);
    expect($achievement->title)->toBe('Juara Olimpiade');
    Storage::disk('public')->assertExists($achievement->image_path);
    $this->get(route('achievements.index'))->assertSee('Juara Olimpiade');
    $this->get(route('achievements.view', $achievement))->assertSee('Deskripsi prestasi terbaru.');
});

test('achievement creation validates all required fields', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $this->actingAs($admin)
        ->from(route('achievements.index'))
        ->post(route('achievements.store'), ['achievement_form' => '1'])
        ->assertRedirect(route('achievements.index'))
        ->assertSessionHasErrors(['title', 'published_at', 'year', 'content', 'image']);

    expect(Achievement::query()->count())->toBe(0);
});

test('an admin can update achievement details and keep the existing image', function () {
    Storage::fake('public');
    $admin = User::factory()->create(['role' => 'admin']);
    $achievement = Achievement::create([
        'content' => 'Deskripsi awal.',
        'image_path' => 'achievements/current.jpg',
        'published_at' => '2026-11-09',
        'title' => 'Judul awal',
        'year' => 2026,
    ]);
    Storage::disk('public')->put($achievement->image_path, 'image');

    $this->actingAs($admin)
        ->get(route('achievements.index'))
        ->assertSuccessful()
        ->assertSee('id="prestasi-form"', false)
        ->assertSee('data-update-url="'.route('achievements.update', $achievement).'"', false)
        ->assertSee('data-title="Judul awal"', false)
        ->assertSee('data-content="Deskripsi awal."', false)
        ->assertSee(Storage::disk('public')->url($achievement->image_path), false);

    $this->actingAs($admin)->put(route('achievements.update', $achievement), [
        'achievement_form' => '1',
        'editing_achievement_id' => $achievement->id,
        'title' => 'Judul diperbarui',
        'published_at' => '2026-11-10',
        'year' => 2025,
        'content' => 'Deskripsi diperbarui.',
    ])->assertRedirect(route('achievements.index'));

    $achievement->refresh();
    expect($achievement->title)->toBe('Judul diperbarui')
        ->and($achievement->published_at->toDateString())->toBe('2026-11-10')
        ->and($achievement->year)->toBe(2025)
        ->and($achievement->content)->toBe('Deskripsi diperbarui.')
        ->and($achievement->image_path)->toBe('achievements/current.jpg');
    Storage::disk('public')->assertExists('achievements/current.jpg');
});

test('an admin can replace an achievement image and the previous file is removed', function () {
    Storage::fake('public');
    $admin = User::factory()->create(['role' => 'admin']);
    $achievement = Achievement::create([
        'content' => 'Deskripsi.',
        'image_path' => 'achievements/old.jpg',
        'published_at' => '2026-11-09',
        'title' => 'Prestasi',
        'year' => 2026,
    ]);
    Storage::disk('public')->put('achievements/old.jpg', 'old image');

    $this->actingAs($admin)->put(route('achievements.update', $achievement), [
        'title' => 'Prestasi',
        'published_at' => '2026-11-09',
        'year' => 2026,
        'content' => 'Deskripsi.',
        'image' => UploadedFile::fake()->image('replacement.jpg'),
    ])->assertRedirect(route('achievements.index'));

    $achievement->refresh();
    expect($achievement->image_path)->not->toBe('achievements/old.jpg');
    Storage::disk('public')->assertMissing('achievements/old.jpg');
    Storage::disk('public')->assertExists($achievement->image_path);
});

test('an admin can delete a selected achievement and its image', function () {
    Storage::fake('public');
    $admin = User::factory()->create(['role' => 'admin']);
    $achievement = Achievement::create([
        'content' => 'Deskripsi.',
        'image_path' => 'achievements/to-delete.jpg',
        'published_at' => '2026-11-09',
        'title' => 'Akan dihapus',
        'year' => 2026,
    ]);
    $otherAchievement = Achievement::create([
        'content' => 'Tetap ada.',
        'image_path' => 'achievements/keep.jpg',
        'published_at' => '2026-11-08',
        'title' => 'Tetap ada',
        'year' => 2026,
    ]);
    Storage::disk('public')->put('achievements/to-delete.jpg', 'image');
    Storage::disk('public')->put('achievements/keep.jpg', 'image');

    $this->actingAs($admin)
        ->delete(route('achievements.destroy', $achievement))
        ->assertRedirect(route('achievements.index'));

    $this->assertModelMissing($achievement);
    $this->assertModelExists($otherAchievement);
    Storage::disk('public')->assertMissing('achievements/to-delete.jpg');
    Storage::disk('public')->assertExists('achievements/keep.jpg');
});

test('deleting an achievement keeps an image still used by another record', function () {
    Storage::fake('public');
    $admin = User::factory()->create(['role' => 'admin']);
    $achievement = Achievement::create([
        'content' => 'First description.',
        'image_path' => 'achievements/shared.jpg',
        'published_at' => '2026-11-09',
        'title' => 'First achievement',
        'year' => 2026,
    ]);
    $otherAchievement = Achievement::create([
        'content' => 'Second description.',
        'image_path' => 'achievements/shared.jpg',
        'published_at' => '2026-11-08',
        'title' => 'Second achievement',
        'year' => 2026,
    ]);
    Storage::disk('public')->put('achievements/shared.jpg', 'shared image');

    $this->actingAs($admin)
        ->delete(route('achievements.destroy', $achievement))
        ->assertRedirect(route('achievements.index'));

    $this->assertModelMissing($achievement);
    $this->assertModelExists($otherAchievement);
    Storage::disk('public')->assertExists('achievements/shared.jpg');
});

test('non-admin users cannot manage achievements', function () {
    $student = User::factory()->create(['role' => 'student']);
    $achievement = Achievement::create([
        'content' => 'Deskripsi.',
        'image_path' => 'achievements/current.jpg',
        'published_at' => '2026-11-09',
        'title' => 'Prestasi',
        'year' => 2026,
    ]);

    $this->actingAs($student)
        ->post(route('achievements.store'))
        ->assertForbidden();

    $this->actingAs($student)
        ->put(route('achievements.update', $achievement))
        ->assertForbidden();

    $this->actingAs($student)
        ->delete(route('achievements.destroy', $achievement))
        ->assertForbidden();
});

test('achievement detail returns not found for a deleted record', function () {
    $this->get(route('achievements.view', 999999))->assertNotFound();
});
