<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shirt extends Model
{
    protected $fillable = [
        'team_id',
        'season',
    ];

    public function team() {
        return $this->belongsTo(Team::class);
    }

    public function details() {
        return $this->hasMany(ShirtDetail::class);
    }

    public function images() {
        return $this->hasMany(Image::class);
    }
}
