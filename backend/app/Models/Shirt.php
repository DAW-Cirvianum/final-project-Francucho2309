<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shirt extends Model
{
    protected $fillable = [
        'team_id',
        'season',
        'size',
        'price'
    ];

    public function team() {
        return $this->belongsTo(Team::class);
    }

    public function categories() {
        return $this->belongsToMany(Category::class, 'shirts_categories');
    }

    public function images() {
        return $this->hasMany(Image::class);
    }
}
