<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_details';

    protected $fillable = [
        'order_id',
        'shirt_id',
        'size',
        'quantity',
        'unit_price'
    ];

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function shirt() {
        return $this->belongsTo(Shirt::class);
    }
}
