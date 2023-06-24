<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class outfits extends Model
{
    use HasFactory;
    protected $attributes = [
        'name' => '',
        'description' => '',
        'price' => '',
        'image' => '',
    ];
    public function products()
    {
        return $this->belongsToMany(Products::class)->withPivot('x', 'y');
    }
    public function comments()
    {
        return $this->hasMany(Comments::class);
    }

    public function likes()
    {
        return $this->hasMany(Likes::class);
    }
}
