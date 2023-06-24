<?php

namespace App\Models;

use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attachments extends Model
{
    protected $fillable = ['path', 'Size', 'extension', 'Type'];
    protected $nullable = ['extension'];


    public function products()
    {
        return $this->belongsTo(Products::class , 'products_id');
    }
}
