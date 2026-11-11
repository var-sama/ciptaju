<?php

namespace Database\Seeders;

use App\Models\Achievement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use RuntimeException;

class AchievementSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $detailContent = 'Salah satu siswa Ciptaju berhasil meraih prestasi membanggakan dalam sebuah perlombaan dan membawa pulang piala sebagai bentuk penghargaan atas kerja kerasnya. Dengan senyum penuh kebanggaan dan semangat kemenangan, ia menunjukkan bahwa usaha yang dilakukan dengan sungguh-sungguh dapat menghasilkan pencapaian yang berarti. Sebelum mengikuti perlombaan, siswa tersebut rutin berlatih dan mempersiapkan diri dengan bimbingan guru serta dukungan penuh dari keluarga. Setiap proses latihan menjadi kesempatan untuk meningkatkan kemampuan, membangun rasa percaya diri, dan belajar menghadapi tantangan dengan sikap pantang menyerah. Prestasi ini tidak hanya menjadi kebanggaan bagi siswa dan keluarganya, tetapi juga bagi seluruh warga sekolah. Pihak sekolah memberikan apresiasi atas pencapaian tersebut dan berharap keberhasilan ini dapat menginspirasi siswa lainnya untuk berani mengikuti berbagai kegiatan, mengembangkan bakat, serta terus berusaha meraih prestasi di bidang yang mereka minati. Pencapaian ini juga menjadi pengingat bahwa kerja sama antara siswa, guru, dan orang tua memiliki peran penting dalam mendukung perkembangan serta keberhasilan setiap peserta didik.';

        $achievements = [
            ['year' => 2099, 'title' => "Meraih Pencapaian Sekolah Dengan Men's Singles Player Of The Year Badminton terbanyak", 'published_at' => '2099-12-20', 'image' => 'achievement1.png'],
            ['year' => 2099, 'title' => 'Meraih Gelar School of the Year Pada Tahun 2099', 'published_at' => '2099-11-15', 'image' => 'acheivement2.png'],
            ['year' => 2099, 'title' => 'Dicap Sebagai Sekolah Dengan Penghasil Pendebat Terbaik', 'published_at' => '2099-08-10', 'image' => 'achievement3.png'],
            ['year' => 2099, 'title' => 'Juara 1 Olimpiade Sains Nasional Bidang Astronomi Terbanyak Satu Asia', 'published_at' => '2099-05-05', 'image' => 'achievement4.png'],
            ['year' => 2098, 'title' => 'Meraih Penghargaan Best Graduate Of The Year', 'published_at' => '2098-12-18', 'image' => 'achievement4.png'],
            ['year' => 2098, 'title' => 'Meraih Penghargaan Sebagai Sekolah Penghasil Public Speaker Terbaik', 'published_at' => '2098-09-12', 'image' => 'achievement5.png'],
            ['year' => 2098, 'title' => 'Sekolah Dengan Partisipasi Lomba Terbanyak Pada Tahun 2098', 'published_at' => '2098-06-01', 'image' => 'achievement6.png'],
            ['year' => 2098, 'title' => 'Juara Umum Kompetisi Robotik Antar Sekolah Tingkat Nasional Terbanyak Sedunia', 'published_at' => '2098-02-14', 'image' => 'achievement7.png'],
            ['year' => 2097, 'title' => 'Sekolah Dengan Pemenang Lomba Terbanyak Pada Tahun 2097', 'published_at' => '2097-11-22', 'image' => 'achievement7.png'],
            ['year' => 2097, 'title' => 'Dicap Sebagai Sekolah Dengan Guru Terbaik', 'published_at' => '2097-08-19', 'image' => 'achievement8.png'],
            ['year' => 2097, 'title' => 'Meraih Pencapaian Sebagai Sekolah Dengan Partisipan Lomba Terbanyak', 'published_at' => '2097-04-11', 'image' => 'achievement9.png'],
            ['year' => 2097, 'title' => 'Medali Emas Festival Seni Terbanyak Sepanjang Abad', 'published_at' => '2097-01-03', 'image' => 'achievement1.png'],
            [
                'year' => 2099,
                'title' => 'Siswa Ciptaju Berhasil Meraih Prestasi dan Membawa Pulang Piala',
                'published_at' => '2099-12-20',
                'image' => 'siswaprestasi.jpg',
                'content' => $detailContent,
            ],
        ];

        foreach ($achievements as $item) {
            $imagePath = 'achievements/'.$item['image'];
            $sourcePath = resource_path('assets/'.$item['image']);
            $imageContents = File::get($sourcePath);

            if (! Storage::disk('public')->exists($imagePath)
                && ! Storage::disk('public')->put($imagePath, $imageContents)) {
                throw new RuntimeException("Unable to restore the Achievement image [{$item['image']}].");
            }

            Achievement::query()->firstOrCreate(
                [
                    'title' => $item['title'],
                    'published_at' => $item['published_at'],
                    'image_path' => $imagePath,
                ],
                [
                    'content' => $item['content'] ?? 'Prestasi sekolah: '.$item['title'].'.',
                    'year' => $item['year'],
                ],
            );
        }
    }
}
