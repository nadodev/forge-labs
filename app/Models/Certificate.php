<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'issuer', 'icon', 'url', 'issued_at', 'sort_order'
    ];

    protected $casts = [
        'issued_at' => 'date',
    ];
}


