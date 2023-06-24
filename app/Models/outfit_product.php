<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class outfit_product extends Model
{
    use HasFactory;
    protected $table = 'outfits_products';

    protected $attributes = [
        'outfit_id',
        'product_id',
        'x' => '',
        'y' => '',
    ];
    public function outfit()
    {
        return $this->belongsTo(outfits::class, 'outfit_id');
    }

    public function product()
    {
        return $this->belongsTo(products::class, 'product_id');
    }

}
