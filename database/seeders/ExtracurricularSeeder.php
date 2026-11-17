<?php

namespace Database\Seeders;

use App\Models\Extracurricular;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use RuntimeException;

class ExtracurricularSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $extracurriculars = [
            [
                'name' => 'Badminton',
                'image' => 'badminton.avif',
                'description' => 'Bulu tangkis atau badminton adalah cabang olahraga raket yang dimainkan oleh dua orang (tunggal) atau dua pasangan (ganda) yang saling berlawanan dengan cara memukul kok (shuttlecock) melewati atas net ke area lawan.',
                'is_active' => true,
                'flip_background' => false,
            ],
            [
                'name' => 'Basket',
                'image' => 'basket.avif',
                'description' => 'Ekstrakurikuler basket untuk mengembangkan kemampuan olahraga, kerja sama tim, dan sportivitas.',
                'is_active' => false,
                'flip_background' => false,
            ],
            [
                'name' => 'Voli',
                'image' => 'volley.jpg',
                'description' => 'Kegiatan olahraga beregu yang melatih kemampuan bermain voli, kerja sama tim, dan sportivitas.',
                'is_active' => false,
                'flip_background' => false,
            ],
            [
                'name' => 'Musik',
                'image' => 'music.jpg',
                'description' => 'Wadah untuk mengembangkan kreativitas dan kemampuan bermusik bersama siswa lainnya.',
                'is_active' => false,
                'flip_background' => false,
            ],
            [
                'name' => 'Ilmu Komputer',
                'image' => 'comp_science.jpg',
                'description' => 'Wadah untuk mempelajari dasar-dasar komputer, pemrograman, teknologi, dan pemecahan masalah secara kreatif.',
                'is_active' => false,
                'flip_background' => false,
            ],
            [
                'name' => 'Matematika',
                'image' => 'math.png',
                'description' => 'Kegiatan untuk memperkuat kemampuan berpikir logis, analitis, dan kreatif melalui pembelajaran matematika.',
                'is_active' => false,
                'flip_background' => false,
            ],
            [
                'name' => 'Desain',
                'image' => 'design.jpg',
                'description' => 'Ruang untuk mengembangkan kreativitas visual dan kemampuan membuat karya desain yang komunikatif.',
                'is_active' => false,
                'flip_background' => false,
            ],
        ];

        foreach ($extracurriculars as $sortOrder => $item) {
            $imagePath = 'extracurriculars/'.$item['image'];
            $sourcePath = resource_path('assets/'.$item['image']);

            if (! File::exists($sourcePath)) {
                throw new RuntimeException("Unable to find the Extracurricular image [{$item['image']}].");
            }

            if (! Storage::disk('public')->exists($imagePath)
                && ! Storage::disk('public')->put($imagePath, File::get($sourcePath))) {
                throw new RuntimeException("Unable to restore the Extracurricular image [{$item['image']}].");
            }

            Extracurricular::query()->firstOrCreate(
                ['name' => $item['name']],
                [
                    'description' => $item['description'],
                    'image_path' => $imagePath,
                    'sort_order' => $sortOrder,
                    'is_active' => $item['is_active'],
                    'flip_background' => $item['flip_background'],
                ],
            );
        }
    }
}
