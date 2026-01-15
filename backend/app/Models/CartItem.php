<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = [
        'cart_id',
        'shirt_id',
        'quantity',
        'size'
    ];

    public function cart() {
        return $this->belongsTo(Cart::class);
    }

    public function shirt() {
        return $this->belongsTo(Shirt::class);
    }
}
