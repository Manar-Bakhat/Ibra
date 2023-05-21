<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'size',
        'extention',
        'type',
    ];

    public function outfit()
    {
        return $this->belongsTo(Outfit::class);
    }
}
