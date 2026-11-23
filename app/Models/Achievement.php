<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['content', 'image_path', 'published_at', 'title', 'year'])]
class Achievement extends Model
{
    protected function casts(): array
    {
        return [
            'published_at' => 'date',
            'year' => 'integer',
        ];
    }
}
