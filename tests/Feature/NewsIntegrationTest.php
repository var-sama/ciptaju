<?php

use App\Models\Banner;
use App\Models\News;
use App\Models\User;
use Database\Seeders\NewsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

test('news schema contains only the required fields', function () {
    expect(Schema::getColumnListing('news'))->toBe([
        'id',
        'title',
        'image_path',
        'published_at',
        'content',
        'created_at',
        'updated_at',
    ]);
});

test('banners are stored in their own table with unique ids', function () {
    expect(Schema::getColumnListing('banners'))
        ->toContain('id', 'image_path', 'title', 'published_at', 'content', 'created_at', 'updated_at');

    $firstBanner = Banner::create(['image_path' => 'banners/first.jpg']);
    $secondBanner = Banner::create(['image_path' => 'banners/second.jpg']);

    expect($firstBanner->id)->not->toBe($secondBanner->id);
});

test('the News page displays banner images stored in the database', function () {
    Storage::fake('public');
    $banner = Banner::create(['image_path' => 'banners/school.jpg']);

    $this->get(route('news.index'))
        ->assertSuccessful()
        ->assertSee(Storage::disk('public')->url($banner->image_path), false);
});

test('an admin can create a banner and its image appears on News', function () {
    Storage::fake('public');
    $admin = User::factory()->create(['role' => 'admin']);

    $this->actingAs($admin)->post(route('banners.store'), [
        'banner_form' => '1',
        'title' => 'Banner Baru',
        'published_at' => '2026-11-10',
        'content' => 'Informasi banner baru.',
        'image' => UploadedFile::fake()->image('school-banner.jpg'),
    ])->assertRedirect(route('news.index'));

    $banner = Banner::query()->firstOrFail();
    $this->assertModelExists($banner);
    Storage::disk('public')->assertExists($banner->image_path);
    expect($banner->title)->toBe('Banner Baru')
        ->and($banner->published_at->toDateString())->toBe('2026-11-10')
        ->and($banner->content)->toBe('Informasi banner baru.');

    $this->get(route('news.index'))
        ->assertSuccessful()
        ->assertSee(Storage::disk('public')->url($banner->image_path), false)
        ->assertSee('Banner Baru')
        ->assertSee('10/11/2026')
        ->assertSee('Informasi banner baru.');
});

test('banner creation requires a valid image', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $this->actingAs($admin)
        ->from(route('news.index'))
        ->post(route('banners.store'), ['banner_form' => '1'])
        ->assertRedirect(route('news.index'))
        ->assertSessionHasErrors('image');

    expect(Banner::query()->count())->toBe(0);
});

test('an admin can update a banner while retaining its current image when no replacement is uploaded', function () {
    Storage::fake('public');
    $admin = User::factory()->create(['role' => 'admin']);
    $banner = Banner::create(['image_path' => 'banners/current.jpg']);
    Storage::disk('public')->put($banner->image_path, 'image');

    $this->actingAs($admin)->put(route('banners.update', $banner), [
        'banner_form' => '1',
        'editing_banner_id' => $banner->id,
        'title' => 'Banner Diperbarui',
        'published_at' => '2026-11-11',
        'content' => 'Informasi yang diperbarui.',
    ])->assertRedirect(route('news.index'));

    expect($banner->refresh()->image_path)->toBe('banners/current.jpg')
        ->and($banner->title)->toBe('Banner Diperbarui')
        ->and($banner->published_at->toDateString())->toBe('2026-11-11')
        ->and($banner->content)->toBe('Informasi yang diperbarui.');
    Storage::disk('public')->assertExists('banners/current.jpg');
});

test('an admin can replace a banner image and the News page shows the replacement', function () {
    Storage::fake('public');
    $admin = User::factory()->create(['role' => 'admin']);
    $banner = Banner::create(['image_path' => 'banners/old.jpg']);
    Storage::disk('public')->put('banners/old.jpg', 'old image');

    $this->actingAs($admin)->put(route('banners.update', $banner), [
        'banner_form' => '1',
        'editing_banner_id' => $banner->id,
        'title' => 'Banner Diganti',
        'published_at' => '2026-11-11',
        'content' => 'Deskripsi banner diganti.',
        'image' => UploadedFile::fake()->image('replacement.jpg'),
    ])->assertRedirect(route('news.index'));

    $banner->refresh();
    expect($banner->image_path)->not->toBe('banners/old.jpg');
    Storage::disk('public')->assertMissing('banners/old.jpg');
    Storage::disk('public')->assertExists($banner->image_path);

    $this->get(route('news.index'))
        ->assertSuccessful()
        ->assertSee(Storage::disk('public')->url($banner->image_path), false)
        ->assertSee('Banner Diganti')
        ->assertSee('Deskripsi banner diganti.');
});

test('an admin can delete a banner and its image without affecting other banners', function () {
    Storage::fake('public');
    $admin = User::factory()->create(['role' => 'admin']);
    $banner = Banner::create(['image_path' => 'banners/to-delete.jpg']);
    $otherBanner = Banner::create(['image_path' => 'banners/to-keep.jpg']);
    Storage::disk('public')->put($banner->image_path, 'image');
    Storage::disk('public')->put($otherBanner->image_path, 'image');

    $this->actingAs($admin)
        ->delete(route('banners.destroy', $banner))
        ->assertRedirect(route('news.index'));

    $this->assertModelMissing($banner);
    $this->assertModelExists($otherBanner);
    Storage::disk('public')->assertMissing('banners/to-delete.jpg');
    Storage::disk('public')->assertExists('banners/to-keep.jpg');
    $this->get(route('news.index'))
        ->assertSuccessful()
        ->assertDontSee(Storage::disk('public')->url('banners/to-delete.jpg'), false)
        ->assertSee(Storage::disk('public')->url('banners/to-keep.jpg'), false);
});

test('deleting a banner does not remove a shared image used by a news record', function () {
    Storage::fake('public');
    $admin = User::factory()->create(['role' => 'admin']);
    $banner = Banner::create(['image_path' => 'news/shared.jpg']);
    News::factory()->create(['image_path' => 'news/shared.jpg']);
    Storage::disk('public')->put('news/shared.jpg', 'shared image');

    $this->actingAs($admin)
        ->delete(route('banners.destroy', $banner))
        ->assertRedirect(route('news.index'));

    $this->assertModelMissing($banner);
    Storage::disk('public')->assertExists('news/shared.jpg');
});

test('a non-admin cannot create, update, or delete banners', function () {
    $student = User::factory()->create(['role' => 'student']);
    $banner = Banner::create(['image_path' => 'banners/current.jpg']);

    $this->actingAs($student)
        ->post(route('banners.store'))
        ->assertForbidden();

    $this->actingAs($student)
        ->put(route('banners.update', $banner))
        ->assertForbidden();

    $this->actingAs($student)
        ->delete(route('banners.destroy', $banner))
        ->assertForbidden();

    $this->assertModelExists($banner);
});

test('news index displays all records and builds its banner from latest news', function () {
    Storage::fake('public');
    $olderNews = News::factory()->create([
        'title' => 'Berita Lama',
        'published_at' => '2026-11-09',
    ]);
    $latestNews = News::factory()->create([
        'title' => 'Berita Terkini',
        'published_at' => '2026-11-10',
    ]);

    $this->get(route('news.index'))
        ->assertSuccessful()
        ->assertSee('Berita Terkini')
        ->assertSee('Berita Lama')
        ->assertSee(route('news.view', $latestNews->id), false)
        ->assertSee(route('news.view', $olderNews->id), false)
        ->assertSee('id="news-banner"', false);
});

test('the News seeder restores records idempotently without requiring an author', function () {
    Storage::fake('public');

    $this->seed(NewsSeeder::class);
    $this->seed(NewsSeeder::class);

    expect(News::query()->count())->toBe(19);

    Storage::disk('public')->assertExists('news/banner_1.png');
    Storage::disk('public')->assertExists('news/news1.png');
    Storage::disk('public')->assertExists('news/news2.png');
    Storage::disk('public')->assertExists('news/news3.png');
});

test('an admin sees the add news button and submission form', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $news = News::factory()->create();

    $this->actingAs($admin)
        ->get(route('news.index'))
        ->assertSuccessful()
        ->assertSee('id="add-news-button"', false)
        ->assertSee('action="'.route('news.store').'"', false)
        ->assertSee('Add News')
        ->assertSee('data-news-edit', false)
        ->assertSee('data-update-url="'.route('news.update', $news).'"', false)
        ->assertSee('data-title="'.$news->title.'"', false)
        ->assertSee('action="'.route('news.destroy', $news).'"', false)
        ->assertDontSee('name="category"', false);
});

test('an admin can open the Banner manager and edit an existing banner', function () {
    Storage::fake('public');
    $admin = User::factory()->create(['role' => 'admin']);
    $banner = Banner::create([
        'content' => 'Banner description',
        'image_path' => 'banners/current.jpg',
        'published_at' => '2026-11-10',
        'title' => 'Saved Banner',
    ]);

    $this->actingAs($admin)
        ->get(route('news.index'))
        ->assertSuccessful()
        ->assertSee('id="manage-banners-button"', false)
        ->assertSee('id="banner-modal"', false)
        ->assertSee('action="'.route('banners.store').'"', false)
        ->assertSee('data-banner-edit', false)
        ->assertSee('data-update-url="'.route('banners.update', $banner).'"', false)
        ->assertSee('data-title="Saved Banner"', false)
        ->assertSee('data-published-at="2026-11-10"', false)
        ->assertSee('data-content="Banner description"', false)
        ->assertSee('name="title"', false)
        ->assertSee('name="published_at"', false)
        ->assertSee('name="content"', false)
        ->assertSee(Storage::disk('public')->url($banner->image_path), false);
});

test('a student does not see admin news controls', function () {
    $student = User::factory()->create(['role' => 'student']);

    $this->actingAs($student)
        ->get(route('news.index'))
        ->assertSuccessful()
        ->assertDontSee('id="add-news-button"', false);
});

test('news detail displays the selected record without author or category', function () {
    Storage::fake('public');
    $news = News::factory()->create([
        'content' => 'Isi berita yang sesuai dengan pilihan.',
        'image_path' => 'news/prestasi.jpg',
        'published_at' => '2026-11-10',
        'title' => 'Prestasi Ciptaju',
    ]);

    $this->get(route('news.view', $news->id))
        ->assertSuccessful()
        ->assertSee('Prestasi Ciptaju')
        ->assertSee('Isi berita yang sesuai dengan pilihan.')
        ->assertSee('10/11/2026')
        ->assertSee(Storage::disk('public')->url($news->image_path), false)
        ->assertDontSee('Nadia Editor');
});

test('news detail returns not found for an unknown id', function () {
    $this->get(route('news.view', 999999))->assertNotFound();
});

test('an admin can store news in the database with an uploaded image', function () {
    Storage::fake('public');
    $admin = User::factory()->create(['role' => 'admin']);

    $this->actingAs($admin)->post(route('news.store'), [
        'title' => 'Berita Baru Ciptaju',
        'published_at' => '2026-11-10',
        'content' => 'Isi berita baru.',
        'image' => UploadedFile::fake()->image('berita.jpg'),
    ])->assertRedirect(route('news.index'));

    $news = News::query()->firstOrFail();

    $this->assertModelExists($news);
    expect($news->title)->toBe('Berita Baru Ciptaju');
    Storage::disk('public')->assertExists($news->image_path);

    $this->get(route('news.index'))->assertSee('Berita Baru Ciptaju');
    $this->get(route('news.view', $news))->assertSee('Isi berita baru.');
});

test('news creation rejects titles longer than 150 characters', function () {
    Storage::fake('public');
    $admin = User::factory()->create(['role' => 'admin']);

    $this->actingAs($admin)->post(route('news.store'), [
        'title' => str_repeat('a', 151),
        'published_at' => '2026-11-10',
        'content' => 'Isi berita baru.',
        'image' => UploadedFile::fake()->image('berita.jpg'),
    ])->assertSessionHasErrors('title');

    expect(News::query()->count())->toBe(0);
});

test('an admin can edit and update news while keeping its current image', function () {
    Storage::fake('public');
    $admin = User::factory()->create(['role' => 'admin']);
    $news = News::factory()->create([
        'content' => 'Isi berita lama.',
        'image_path' => 'news/current.jpg',
        'title' => 'Judul Lama',
    ]);
    Storage::disk('public')->put($news->image_path, 'image');

    $this->actingAs($admin)
        ->get(route('news.index'))
        ->assertSuccessful()
        ->assertSee('data-news-edit', false)
        ->assertSee('data-update-url="'.route('news.update', $news).'"', false)
        ->assertSee('data-title="Judul Lama"', false)
        ->assertSee('data-published-at="'.$news->published_at->format('Y-m-d').'"', false)
        ->assertSee('data-content="'.$news->content.'"', false)
        ->assertSee('data-image-url="'.Storage::disk('public')->url($news->image_path).'"', false)
        ->assertSee('id="news-modal"', false)
        ->assertSee('id="news-form"', false);

    $this->actingAs($admin)->put(route('news.update', $news), [
        'title' => 'Judul Diperbarui',
        'published_at' => '2026-11-10',
        'content' => 'Isi berita diperbarui.',
    ])->assertRedirect(route('news.index'));

    $news->refresh();
    expect($news->title)->toBe('Judul Diperbarui')
        ->and($news->content)->toBe('Isi berita diperbarui.')
        ->and($news->image_path)->toBe('news/current.jpg');
    Storage::disk('public')->assertExists('news/current.jpg');
    $this->get(route('news.view', $news))->assertSee('Isi berita diperbarui.');
});

test('edit validation errors reopen the shared modal with the selected news', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $news = News::factory()->create(['title' => 'Judul Sebelumnya']);

    $this->from(route('news.index'))
        ->actingAs($admin)
        ->put(route('news.update', $news), [
            'editing_news_id' => $news->id,
            'title' => str_repeat('a', 151),
            'published_at' => $news->published_at->format('Y-m-d'),
            'content' => 'Isi berita.',
        ])
        ->assertRedirect(route('news.index'))
        ->assertSessionHasErrors('title')
        ->assertSessionHas('_old_input.editing_news_id', $news->id);

    $this->get(route('news.index'))
        ->assertSuccessful()
        ->assertSee('Edit News')
        ->assertSee('name="editing_news_id"', false)
        ->assertSee('value="'.$news->id.'"', false)
        ->assertSee('id="news-modal"', false);
});

test('an admin can replace a news image and the previous image is removed', function () {
    Storage::fake('public');
    $admin = User::factory()->create(['role' => 'admin']);
    $news = News::factory()->create(['image_path' => 'news/old.jpg']);
    Storage::disk('public')->put('news/old.jpg', 'old image');

    $this->actingAs($admin)->put(route('news.update', $news), [
        'title' => $news->title,
        'published_at' => $news->published_at->format('Y-m-d'),
        'content' => $news->content,
        'image' => UploadedFile::fake()->image('replacement.jpg'),
    ])->assertRedirect(route('news.index'));

    $news->refresh();
    expect($news->image_path)->not->toBe('news/old.jpg');
    Storage::disk('public')->assertMissing('news/old.jpg');
    Storage::disk('public')->assertExists($news->image_path);
});

test('replacing a shared news image keeps it for other records', function () {
    Storage::fake('public');
    $admin = User::factory()->create(['role' => 'admin']);
    $news = News::factory()->create(['image_path' => 'news/shared.jpg']);
    News::factory()->create(['image_path' => 'news/shared.jpg']);
    Storage::disk('public')->put('news/shared.jpg', 'shared image');

    $this->actingAs($admin)->put(route('news.update', $news), [
        'title' => $news->title,
        'published_at' => $news->published_at->format('Y-m-d'),
        'content' => $news->content,
        'image' => UploadedFile::fake()->image('replacement.jpg'),
    ])->assertRedirect(route('news.index'));

    Storage::disk('public')->assertExists('news/shared.jpg');
});

test('deleting a news record keeps an image still used by another record', function () {
    Storage::fake('public');
    $admin = User::factory()->create(['role' => 'admin']);
    $news = News::factory()->create(['image_path' => 'news/shared.jpg']);
    $otherNews = News::factory()->create(['image_path' => 'news/shared.jpg']);
    Storage::disk('public')->put('news/shared.jpg', 'shared image');

    $this->actingAs($admin)
        ->delete(route('news.destroy', $news))
        ->assertRedirect(route('news.index'));

    $this->assertModelMissing($news);
    $this->assertModelExists($otherNews);
    Storage::disk('public')->assertExists('news/shared.jpg');
});

test('an admin can delete news and its image', function () {
    Storage::fake('public');
    $admin = User::factory()->create(['role' => 'admin']);
    $news = News::factory()->create(['image_path' => 'news/to-delete.jpg']);
    Storage::disk('public')->put('news/to-delete.jpg', 'image');

    $this->actingAs($admin)
        ->delete(route('news.destroy', $news))
        ->assertRedirect(route('news.index'));

    $this->assertModelMissing($news);
    Storage::disk('public')->assertMissing('news/to-delete.jpg');
    $this->get(route('news.view', $news->id))->assertNotFound();
});

test('a non-admin cannot create, update, or delete news', function () {
    $student = User::factory()->create(['role' => 'student']);
    $news = News::factory()->create();

    $this->actingAs($student)
        ->post(route('news.store'))
        ->assertForbidden();

    $this->actingAs($student)
        ->put(route('news.update', $news))
        ->assertForbidden();

    $this->actingAs($student)
        ->delete(route('news.destroy', $news))
        ->assertForbidden();

    expect(News::query()->count())->toBe(1);
});
