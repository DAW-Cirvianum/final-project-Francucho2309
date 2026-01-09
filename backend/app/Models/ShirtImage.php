<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShirtImage extends Model
{
    protected $fillable = [
        'shirt_id',
        'image_path'
    ];

    public function shirt() {
        return $this->belongsTo(Shirt::class);
    }
}
