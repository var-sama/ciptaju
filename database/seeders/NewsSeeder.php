<?php

namespace Database\Seeders;

use App\Models\News;
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
        $newsRecords = [
            [
                'title' => 'Amond Aye Winning Programming Competition',
                'image' => 'banner_1.png',
                'content' => 'Amond Aye berhasil memenangkan kompetisi pemrograman.',
                'published_at' => '2099-12-20',
                'copies' => 1,
            ],
            [
                'title' => 'Berita Kedua',
                'image' => 'news2.png',
                'content' => 'Berita terbaru kedua dari Ciptaju.',
                'published_at' => '2099-12-21',
                'copies' => 1,
            ],
            [
                'title' => 'Berita Ketiga',
                'image' => 'news3.png',
                'content' => 'Berita terbaru ketiga dari Ciptaju.',
                'published_at' => '2099-12-22',
                'copies' => 1,
            ],
            [
                'title' => 'Informasi Beasiswa Universitas Two Win Tahun 2077',
                'image' => 'news1.png',
                'content' => 'Informasi beasiswa Universitas Two Win tahun 2077.',
                'published_at' => '2099-12-20',
                'copies' => 8,
            ],
            [
                'title' => 'Kelulusan Angkatan Tahun 2050 Pada Tahun 2060',
                'image' => 'news2.png',
                'content' => 'Informasi kelulusan angkatan tahun 2050 pada tahun 2060.',
                'published_at' => '2099-12-20',
                'copies' => 4,
            ],
            [
                'title' => 'Mayreel Athuath Menang Kompetisi MTK Antar Daerah',
                'image' => 'news3.png',
                'content' => 'Mayreel Athuath berhasil memenangkan kompetisi matematika antar daerah.',
                'published_at' => '2099-12-20',
                'copies' => 4,
            ],
        ];

        foreach ($newsRecords as $item) {
            $imagePath = 'news/'.$item['image'];
            $sourcePath = resource_path('assets/'.$item['image']);
            $imageContents = File::get($sourcePath);

            if (! Storage::disk('public')->exists($imagePath)
                && ! Storage::disk('public')->put($imagePath, $imageContents)) {
                throw new RuntimeException("Unable to restore the News image [{$item['image']}].");
            }

            $existingCopies = News::query()
                ->where('title', $item['title'])
                ->where('image_path', $imagePath)
                ->count();

            if ($existingCopies > 0) {
                News::query()
                    ->where('title', $item['title'])
                    ->where('image_path', $imagePath)
                    ->update(['published_at' => $item['published_at']]);
            }

            for ($copy = $existingCopies; $copy < $item['copies']; $copy++) {
                News::create([
                    'content' => $item['content'],
                    'image_path' => $imagePath,
                    'published_at' => $item['published_at'],
                    'title' => $item['title'],
                ]);
            }
        }
    }
}
