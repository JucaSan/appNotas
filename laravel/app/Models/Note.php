<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{

    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'user_id',
        'type',
        'is_important',
        'reminder_date',
        'metadata',
    ];

    protected $casts = [
        'metadata' => 'array',
        'reminder_date' => 'datetime',
    ];
    
}
