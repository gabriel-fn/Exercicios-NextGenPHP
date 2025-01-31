<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoredBook extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'created_at' => 'string',
            'updated_at' => 'string',
        ];
    }
}
