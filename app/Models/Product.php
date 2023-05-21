<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'Name',
        'Description',
        'Price',
        'Size',
        'count',
        'id_Images',
        'Color',
        'created_at',
        'created_By',
    ];

    public function outfits()
    {
        return $this->belongsToMany(Outfit::class);
    }
}
