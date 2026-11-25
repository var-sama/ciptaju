<?php

namespace Database\Seeders;

use App\Models\News;
use Database\Seeders\Concerns\SeedsSnapshotRecords;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    use SeedsSnapshotRecords;
    use WithoutModelEvents;

    public function run(): void
    {
        $this->seedSnapshot('news', new News);
    }
}
