<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimelineItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'subtitle', 'description', 'date', 'icon', 'sort_order'
    ];

    protected $casts = [
        'date' => 'date',
    ];
}


