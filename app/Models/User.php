<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Orders;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    protected $table="users";

    protected $fillable = [
        'Gender',
        'username',
        'Password',
        'email',
        'FirstName',
        'LastName',
        'Address',
        'PhoneNumber',
        'id_role',
        'NomTitulair',
        'FinValidation',
        'NumCart'
    ];

    public function orders()
    {
        return $this->hasMany(Orders::class,'created_By');
    }

}
