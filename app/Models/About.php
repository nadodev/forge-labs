<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'subtitle', 'bio', 'photo_url', 'highlights', 'social_links'
    ];

    protected $casts = [
        'highlights' => 'array',
        'social_links' => 'array',
    ];
}


