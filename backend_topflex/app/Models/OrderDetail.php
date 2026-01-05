<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'order_id',
        'shirt_id',
        'quantity',
        'price',
        'size'
    ];

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function shirt() {
        return $this->belongsTo(Shirt::class);
    }
}
