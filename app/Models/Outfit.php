<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outfit extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_By',
        'name',
        'description',
        'Price',
        'Size',
        'Type',
        'id_tags',
        'id_Produit',
        'id_Images',
    ];
    
    //un outfit a plusieurs tags
    public function tags()
    {
        return $this->hasMany(Tag::class);
    }
    //un outfit peut contenir plusieurs products
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
    // un outfits a un seule attachments
    public function attachment()
    {
        return $this->hasOne(Attachment::class);
    }
}
