<?php

use App\Models\Extracurricular;
use App\Models\User;
use Database\Seeders\ExtracurricularSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

test('extracurricular schema stores every field used by the page', function () {
    expect(Schema::getColumnListing('extracurriculars'))->toBe([
        'id',
        'name',
        'description',
        'image_path',
        'sort_order',
        'is_active',
        'flip_background',
        'created_at',
        'updated_at',
    ]);
});

test('extracurricular seeder restores every existing item and image without duplicates', function () {
    Storage::fake('public');

    $this->seed(ExtracurricularSeeder::class);
    $this->seed(ExtracurricularSeeder::class);

    expect(Extracurricular::query()->count())->toBe(7)
        ->and(Extracurricular::query()->orderBy('sort_order')->value('name'))->toBe('Badminton')
        ->and(Extracurricular::query()->where('is_active', true)->value('name'))->toBe('Badminton')
        ->and(Extracurricular::query()->where('flip_background', true)->count())->toBe(0);

    foreach ([
        'badminton.avif',
        'basket.avif',
        'volley.jpg',
        'music.jpg',
        'comp_science.jpg',
        'math.png',
        'design.jpg',
    ] as $image) {
        Storage::disk('public')->assertExists('extracurriculars/'.$image);
    }
});

test('extracurricular page reads every item and its complete content from the database', function () {
    Storage::fake('public');
    $extracurricular = Extracurricular::create([
        'name' => 'Ekskul dari database',
        'description' => 'Deskripsi lengkap dari database.',
        'image_path' => 'extracurriculars/database.jpg',
        'sort_order' => 1,
        'is_active' => true,
        'flip_background' => false,
    ]);

    $this->get(route('extracurriculars.index'))
        ->assertSuccessful()
        ->assertSee('Ekskul dari database')
        ->assertSee('Deskripsi lengkap dari database.')
        ->assertSee(Storage::disk('public')->url($extracurricular->image_path), false);
});

test('admin page provides persistent create edit and confirmed delete forms', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $extracurricular = Extracurricular::create([
        'name' => 'Ekskul Admin',
        'description' => 'Deskripsi admin.',
        'image_path' => 'extracurriculars/admin.jpg',
    ]);

    $this->actingAs($admin)
        ->get(route('extracurriculars.index'))
        ->assertSuccessful()
        ->assertSee('id="ekskul-form"', false)
        ->assertSee('data-create-action="'.route('extracurriculars.store').'"', false)
        ->assertSee('data-update-url="'.route('extracurriculars.update', $extracurricular).'"', false)
        ->assertSee('action="'.route('extracurriculars.destroy', $extracurricular).'"', false)
        ->assertSee('onsubmit="return confirm(', false)
        ->assertSee('group-hover/edit:text-[#044952]', false)
        ->assertSee('name="image"', false)
        ->assertSee('id="ekskul-image-preview"', false);
});

test('an admin can create an extracurricular with an uploaded image', function () {
    Storage::fake('public');
    $admin = User::factory()->create(['role' => 'admin']);

    $this->actingAs($admin)->post(route('extracurriculars.store'), [
        'name' => 'Klub Baru',
        'description' => 'Deskripsi klub baru.',
        'image' => UploadedFile::fake()->image('klub.jpg'),
    ])->assertRedirect(route('extracurriculars.index'));

    $extracurricular = Extracurricular::query()->firstOrFail();
    $this->assertModelExists($extracurricular);
    expect($extracurricular->name)->toBe('Klub Baru')
        ->and($extracurricular->description)->toBe('Deskripsi klub baru.');
    Storage::disk('public')->assertExists($extracurricular->image_path);
    $this->get(route('extracurriculars.index'))->assertSee('Klub Baru');
});

test('extracurricular creation validates required fields unique names and uploaded image type', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    Extracurricular::create([
        'name' => 'Nama Terpakai',
        'description' => 'Deskripsi.',
        'image_path' => 'extracurriculars/used.jpg',
    ]);

    $this->actingAs($admin)
        ->from(route('extracurriculars.index'))
        ->post(route('extracurriculars.store'))
        ->assertRedirect(route('extracurriculars.index'))
        ->assertSessionHasErrors(['name', 'description', 'image']);

    $this->actingAs($admin)
        ->from(route('extracurriculars.index'))
        ->post(route('extracurriculars.store'), [
            'name' => 'Nama Terpakai',
            'description' => 'Deskripsi duplikat.',
            'image' => UploadedFile::fake()->create('dokumen.pdf', 10, 'application/pdf'),
        ])
        ->assertRedirect(route('extracurriculars.index'))
        ->assertSessionHasErrors(['name', 'image']);

    expect(Extracurricular::query()->count())->toBe(1);
});

test('an admin can update an extracurricular and retain its image when none is uploaded', function () {
    Storage::fake('public');
    $admin = User::factory()->create(['role' => 'admin']);
    $extracurricular = Extracurricular::create([
        'name' => 'Nama Awal',
        'description' => 'Deskripsi awal.',
        'image_path' => 'extracurriculars/current.jpg',
    ]);
    Storage::disk('public')->put($extracurricular->image_path, 'image');

    $this->actingAs($admin)->put(route('extracurriculars.update', $extracurricular), [
        'name' => 'Nama Diperbarui',
        'description' => 'Deskripsi diperbarui.',
    ])->assertRedirect(route('extracurriculars.index'));

    expect($extracurricular->refresh()->name)->toBe('Nama Diperbarui')
        ->and($extracurricular->description)->toBe('Deskripsi diperbarui.')
        ->and($extracurricular->image_path)->toBe('extracurriculars/current.jpg');
    Storage::disk('public')->assertExists('extracurriculars/current.jpg');
});

test('an admin can replace an extracurricular image and the previous file is removed', function () {
    Storage::fake('public');
    $admin = User::factory()->create(['role' => 'admin']);
    $extracurricular = Extracurricular::create([
        'name' => 'Ekskul',
        'description' => 'Deskripsi.',
        'image_path' => 'extracurriculars/old.jpg',
    ]);
    Storage::disk('public')->put($extracurricular->image_path, 'old image');

    $this->actingAs($admin)->put(route('extracurriculars.update', $extracurricular), [
        'name' => 'Ekskul',
        'description' => 'Deskripsi.',
        'image' => UploadedFile::fake()->image('replacement.jpg'),
    ])->assertRedirect(route('extracurriculars.index'));

    $extracurricular->refresh();
    expect($extracurricular->image_path)->not->toBe('extracurriculars/old.jpg');
    Storage::disk('public')->assertMissing('extracurriculars/old.jpg');
    Storage::disk('public')->assertExists($extracurricular->image_path);
});

test('an admin can delete an extracurricular and its image', function () {
    Storage::fake('public');
    $admin = User::factory()->create(['role' => 'admin']);
    $extracurricular = Extracurricular::create([
        'name' => 'Ekskul Hapus',
        'description' => 'Deskripsi.',
        'image_path' => 'extracurriculars/to-delete.jpg',
    ]);
    Storage::disk('public')->put($extracurricular->image_path, 'image');

    $this->actingAs($admin)
        ->delete(route('extracurriculars.destroy', $extracurricular))
        ->assertRedirect(route('extracurriculars.index'));

    $this->assertModelMissing($extracurricular);
    Storage::disk('public')->assertMissing('extracurriculars/to-delete.jpg');
});

test('an admin can delete an extracurricular when its image file is already missing', function () {
    Storage::fake('public');
    $admin = User::factory()->create(['role' => 'admin']);
    $extracurricular = Extracurricular::create([
        'name' => 'Ekskul tanpa file',
        'description' => 'Deskripsi.',
        'image_path' => 'extracurriculars/missing.jpg',
    ]);

    $this->actingAs($admin)
        ->delete(route('extracurriculars.destroy', $extracurricular))
        ->assertRedirect(route('extracurriculars.index'));

    $this->assertModelMissing($extracurricular);
});

test('a non-admin cannot create update or delete extracurriculars', function () {
    $student = User::factory()->create(['role' => 'student']);
    $extracurricular = Extracurricular::create([
        'name' => 'Ekskul Terjaga',
        'description' => 'Deskripsi.',
        'image_path' => 'extracurriculars/current.jpg',
    ]);

    $this->actingAs($student)
        ->post(route('extracurriculars.store'))
        ->assertForbidden();

    $this->actingAs($student)
        ->put(route('extracurriculars.update', $extracurricular))
        ->assertForbidden();

    $this->actingAs($student)
        ->delete(route('extracurriculars.destroy', $extracurricular))
        ->assertForbidden();
});

test('deleting an extracurricular preserves an image still used by another record', function () {
    Storage::fake('public');
    $admin = User::factory()->create(['role' => 'admin']);
    $extracurricular = Extracurricular::create([
        'name' => 'Ekskul Pertama',
        'description' => 'Deskripsi pertama.',
        'image_path' => 'extracurriculars/shared.jpg',
    ]);
    $otherExtracurricular = Extracurricular::create([
        'name' => 'Ekskul Kedua',
        'description' => 'Deskripsi kedua.',
        'image_path' => 'extracurriculars/shared.jpg',
    ]);
    Storage::disk('public')->put('extracurriculars/shared.jpg', 'shared image');

    $this->actingAs($admin)
        ->delete(route('extracurriculars.destroy', $extracurricular))
        ->assertRedirect(route('extracurriculars.index'));

    $this->assertModelMissing($extracurricular);
    $this->assertModelExists($otherExtracurricular);
    Storage::disk('public')->assertExists('extracurriculars/shared.jpg');
});
