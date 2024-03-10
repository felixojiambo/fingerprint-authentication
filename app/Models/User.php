<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'email', 'password', 'fingerprint',
    ];
    
}


// use Laravel\Sanctum\HasApiTokens;

// class User extends Authenticatable
// {
//     use HasApiTokens, Notifiable;
// }

