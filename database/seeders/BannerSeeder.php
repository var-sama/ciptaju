<?php

namespace Database\Seeders;

use App\Models\Banner;
use Database\Seeders\Concerns\SeedsSnapshotRecords;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    use SeedsSnapshotRecords;
    use WithoutModelEvents;

    public function run(): void
    {
        $this->seedSnapshot('banners', new Banner);
    }
}
