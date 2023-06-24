<?php

namespace App\Models;

use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colors extends Model
{
    use HasFactory;


    public function products()
    {
        return $this->belongsToMany(Products::class, 'products_colors', 'colors_id', 'products_id');
    }

    protected $fillable =[
        'color',
    ];
}
