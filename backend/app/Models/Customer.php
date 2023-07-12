<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
// class Customer extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    // use HasFactory;

    protected $guard = 'customer';

    protected $fillable = [
        'nisn',
        'password',
    ];

    protected $hidden = [
        'password',
        // 'remember_token',
    ];
}
