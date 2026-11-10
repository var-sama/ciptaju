<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use RuntimeException;

class NewsSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Restore the original News cards from the frontend dummy data.
     */
    public function run(): void
    {
        $author = User::query()->where('role', 'admin')->first()
            ?? User::query()->first();

        if ($author === null) {
            throw new RuntimeException('Create a user before seeding the legacy News records.');
        }

        $legacyNews = [
            [
                'title' => 'Amond Aye Winning Programming Competition',
                'category' => 'Berita Terbaru',
                'image' => 'banner_1.png',
                'content' => 'Amond Aye berhasil memenangkan kompetisi pemrograman.',
                'is_featured' => true,
                'published_at' => '2099-12-20',
            ],
            [
                'title' => 'Berita Kedua',
                'category' => 'Berita Terbaru',
                'image' => 'news2.png',
                'content' => 'Berita terbaru kedua dari Ciptaju.',
                'is_featured' => true,
                'published_at' => '2099-12-21',
            ],
            [
                'title' => 'Berita Ketiga',
                'category' => 'Berita Terbaru',
                'image' => 'news3.png',
                'content' => 'Berita terbaru ketiga dari Ciptaju.',
                'is_featured' => true,
                'published_at' => '2099-12-22',
            ],
            [
                'title' => 'Informasi Beasiswa Universitas Two Win Tahun 2077',
                'category' => 'Beasiswa',
                'image' => 'news1.png',
                'content' => 'Informasi beasiswa Universitas Two Win tahun 2077.',
                'is_featured' => false,
                'published_at' => '2099-12-20',
            ],
            [
                'title' => 'Kelulusan Angkatan Tahun 2050 Pada Tahun 2060',
                'category' => 'Kelulusan',
                'image' => 'news2.png',
                'content' => 'Informasi kelulusan angkatan tahun 2050 pada tahun 2060.',
                'is_featured' => false,
                'published_at' => '2099-12-20',
            ],
            [
                'title' => 'Mayreel Athuath Menang Kompetisi MTK Antar Daerah',
                'category' => 'Kompetisi',
                'image' => 'news3.png',
                'content' => 'Mayreel Athuath berhasil memenangkan kompetisi matematika antar daerah.',
                'is_featured' => false,
                'published_at' => '2099-12-20',
            ],
            [
                'title' => 'Informasi Beasiswa Universitas Two Win Tahun 2077',
                'category' => 'Informasi Beasiswa',
                'image' => 'news1.png',
                'content' => 'Informasi beasiswa Universitas Two Win tahun 2077.',
                'is_featured' => false,
                'published_at' => '2099-12-20',
            ],
        ];

        foreach ($legacyNews as $item) {
            $imagePath = 'news/'.$item['image'];
            $sourcePath = resource_path('assets/'.$item['image']);
            $imageContents = File::get($sourcePath);

            if (! Storage::disk('public')->exists($imagePath)
                && ! Storage::disk('public')->put($imagePath, $imageContents)) {
                throw new RuntimeException("Unable to restore the News image [{$item['image']}].");
            }

            $copies = $item['is_featured'] ? 1 : 4;
            $existingCopies = News::query()
                ->where('title', $item['title'])
                ->where('category', $item['category'])
                ->where('image_path', $imagePath)
                ->where('is_featured', $item['is_featured'])
                ->count();

            if ($existingCopies > 0) {
                News::query()
                    ->where('title', $item['title'])
                    ->where('category', $item['category'])
                    ->where('image_path', $imagePath)
                    ->where('is_featured', $item['is_featured'])
                    ->update(['published_at' => $item['published_at']]);
            }

            for ($copy = $existingCopies; $copy < $copies; $copy++) {
                News::create([
                    'author_id' => $author->id,
                    'category' => $item['category'],
                    'content' => $item['content'],
                    'image_path' => $imagePath,
                    'is_featured' => $item['is_featured'],
                    'published_at' => $item['published_at'],
                    'title' => $item['title'],
                ]);
            }
        }
    }
}
