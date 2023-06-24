<?php

namespace App\Models;

use App\Models\Colors;
use App\Models\categories;
use App\Models\attachments;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;



    public function colors()
    {
        return $this->belongsToMany(Colors::class, 'products_colors', 'products_id', 'colors_id');
    }

    public function categories()
    {
        return $this->belongsToMany(categories::class, 'products_categories', 'products_id', 'categories_id');
    }

    public function attachments()
    {
        return $this->hasMany(attachments::class );
    }

    public function outfits()
    {
        return $this->belongsToMany(outfits::class)->withPivot('x', 'y');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected $fillable =[

        'Name',
        'Description',
        'Price',
        'Size',

    ];
}

