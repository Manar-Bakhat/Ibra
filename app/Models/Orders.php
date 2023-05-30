<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $table="orders";


    public $timestamps = true;

    protected $fillable = [
        'total',
        'created_By'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'created_By');
    }

    public function products()
    {
        return $this->belongsToMany(products::class, 'orders_products', 'orders_id', 'products_id');
    }
}
