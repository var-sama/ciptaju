<?php

namespace Database\Seeders\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use RuntimeException;

trait SeedsSnapshotRecords
{
    protected function seedSnapshot(string $snapshotName, Model $model): void
    {
        $snapshotPath = database_path('seeders/data/'.$snapshotName.'.json');
        $records = json_decode(File::get($snapshotPath), true, flags: JSON_THROW_ON_ERROR);

        if (! is_array($records) || ! array_is_list($records) || $records === []) {
            throw new RuntimeException("The seeder snapshot [{$snapshotPath}] is empty or invalid.");
        }

        $imagePaths = [];

        foreach ($records as $record) {
            if (
                ! is_array($record)
                || ! is_int($record['id'] ?? null)
                || ! is_string($record['image_path'] ?? null)
                || $record['image_path'] === ''
            ) {
                throw new RuntimeException("The seeder snapshot [{$snapshotPath}] contains an invalid record.");
            }

            $imagePaths[$record['image_path']] = true;
        }

        $publicDisk = Storage::disk('public');

        foreach (array_keys($imagePaths) as $imagePath) {
            $sourcePath = database_path('seeders/data/images/'.$imagePath);

            if (! File::isFile($sourcePath)) {
                throw new RuntimeException("The seeder image [{$sourcePath}] does not exist.");
            }

            if (! $publicDisk->put($imagePath, File::get($sourcePath))) {
                throw new RuntimeException("Unable to copy the seeder image to [{$imagePath}].");
            }
        }

        $table = $model->getTable();

        foreach ($records as $record) {
            DB::table($table)->updateOrInsert(
                ['id' => $record['id']],
                $record,
            );
        }
    }
}
