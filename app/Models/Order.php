<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','email','cpf','whatsapp','notes','total','contact_method','status'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}


