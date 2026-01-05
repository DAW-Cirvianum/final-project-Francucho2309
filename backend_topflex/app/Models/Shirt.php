<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shirt extends Model
{
    protected $fillable = [
        'name',
        'season',
        'price',
        'team_id'
    ];

    public function team() {
        return $this->belongsTo(Team::class);
    }

    public function images() {
        return $this->hasMany(ShirtImage::class);
    }
}
