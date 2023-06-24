<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    use HasFactory;
    protected $attributes = [
        'outfits_id' => '',
        'user_id' => '',
    ];
    public function outfits()
    {
        return $this->belongsTo(outfits::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
