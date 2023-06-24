<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;
    protected $fillable = [
        'outfits_id' => '',
        'user_id' => '',
        'content' => '',
    ];

    public function outfits()
    {
        return $this->belongsTo(outfits::class , 'outfits_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }
}
