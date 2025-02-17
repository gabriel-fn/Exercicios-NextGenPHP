<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'stored_book_id',
        'reserved_at',
        'returned_at',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'string',
            'updated_at' => 'string',
        ];
    }
}
