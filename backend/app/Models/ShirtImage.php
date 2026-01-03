<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShirtImage extends Model
{
    protected $table = 'shirts_images';

    protected $fillable = [
        'shirt_id',
        'url_image'
    ];

    public function shirt() {
        return $this->belongsTo(Shirt::class);
    }
}
