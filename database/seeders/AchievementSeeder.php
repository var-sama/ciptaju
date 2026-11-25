<?php

namespace Database\Seeders;

use App\Models\Achievement;
use Database\Seeders\Concerns\SeedsSnapshotRecords;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AchievementSeeder extends Seeder
{
    use SeedsSnapshotRecords;
    use WithoutModelEvents;

    public function run(): void
    {
        $this->seedSnapshot('achievements', new Achievement);
    }
}
