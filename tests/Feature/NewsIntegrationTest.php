<?php

use App\Models\News;
use App\Models\User;
use Database\Seeders\NewsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

test('news index displays database records with links to their details', function () {
    Storage::fake('public');
    $author = User::factory()->create(['name' => 'Nadia Editor']);
    $olderNews = News::factory()->for($author, 'author')->create([
        'title' => 'Berita Lama',
        'image_path' => 'news/older.jpg',
    ]);
    $latestNews = News::factory()->for($author, 'author')->create([
        'title' => 'Berita Terkini',
        'image_path' => 'news/latest.jpg',
    ]);

    $this->get(route('news.index'))
        ->assertSuccessful()
        ->assertSee('Berita Terkini')
        ->assertSee('Berita Lama')
        ->assertSee(route('news.view', $latestNews->id), false)
        ->assertSee(route('news.view', $olderNews->id), false)
        ->assertDontSee('Amond Aye Winning Programming Competition');
});

test('news index renders featured database records in both banner sliders', function () {
    $featuredNews = News::factory()->create([
        'is_featured' => true,
        'title' => 'Amond Aye Winning Programming Competition',
    ]);

    $this->get(route('news.index'))
        ->assertSuccessful()
        ->assertSee('id="news-banner"', false)
        ->assertSee('data-news-slides=', false)
        ->assertSee('Amond Aye Winning Programming Competition')
        ->assertSee(str_replace('/', '\\/', route('news.view', $featuredNews->id)), false);
});

test('the legacy News seeder restores banner and card records idempotently', function () {
    Storage::fake('public');
    User::factory()->create(['role' => 'admin']);

    $this->seed(NewsSeeder::class);
    $this->seed(NewsSeeder::class);

    expect(News::query()->count())->toBe(19)
        ->and(News::query()->where('is_featured', true)->count())->toBe(3)
        ->and(News::query()->where('is_featured', false)->count())->toBe(16);

    Storage::disk('public')->assertExists('news/banner_1.png');
    Storage::disk('public')->assertExists('news/news1.png');
    Storage::disk('public')->assertExists('news/news2.png');
    Storage::disk('public')->assertExists('news/news3.png');
});

test('an admin sees the add news button and submission form', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $this->actingAs($admin)
        ->get(route('news.index'))
        ->assertSuccessful()
        ->assertSee('id="add-news-button"', false)
        ->assertSee('action="'.route('news.store').'"', false)
        ->assertSee('Add News');
});

test('a student does not see the admin add news button', function () {
    $student = User::factory()->create(['role' => 'student']);

    $this->actingAs($student)
        ->get(route('news.index'))
        ->assertSuccessful()
        ->assertDontSee('id="add-news-button"', false);
});

test('news detail displays the selected record', function () {
    Storage::fake('public');
    $author = User::factory()->create(['name' => 'Nadia Editor']);
    $news = News::factory()->for($author, 'author')->create([
        'category' => 'Prestasi',
        'content' => 'Isi berita yang sesuai dengan pilihan.',
        'image_path' => 'news/prestasi.jpg',
        'published_at' => '2026-11-10',
        'title' => 'Prestasi Ciptaju',
    ]);

    $this->get(route('news.view', $news->id))
        ->assertSuccessful()
        ->assertSee('Prestasi Ciptaju')
        ->assertSee('Prestasi')
        ->assertSee('Nadia Editor')
        ->assertSee('Isi berita yang sesuai dengan pilihan.')
        ->assertSee('10/11/2026')
        ->assertSee(Storage::disk('public')->url($news->image_path), false);
});

test('news detail returns not found for an unknown id', function () {
    $this->get(route('news.view', 999999))->assertNotFound();
});

test('an admin can store news in the database with an uploaded image', function () {
    Storage::fake('public');
    $admin = User::factory()->create(['role' => 'admin']);

    $this->actingAs($admin)->post(route('news.store'), [
        'title' => 'Berita Baru Ciptaju',
        'category' => 'Kegiatan',
        'published_at' => '2026-11-10',
        'content' => 'Isi berita baru.',
        'image' => UploadedFile::fake()->image('berita.jpg'),
    ])->assertRedirect(route('news.index'));

    $news = News::query()->firstOrFail();

    $this->assertModelExists($news);
    expect($news->author_id)->toBe($admin->id)
        ->and($news->title)->toBe('Berita Baru Ciptaju');
    Storage::disk('public')->assertExists($news->image_path);
});

test('a non-admin cannot store news', function () {
    $student = User::factory()->create(['role' => 'student']);

    $this->actingAs($student)
        ->post(route('news.store'))
        ->assertForbidden();

    expect(News::query()->count())->toBe(0);
});
