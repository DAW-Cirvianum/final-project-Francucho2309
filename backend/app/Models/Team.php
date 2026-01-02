<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name',
        'league',
        'country'
    ];

    public function shirts() {
        return $this->hasMany(Shirt::class);
    }
}
