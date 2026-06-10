<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // <--- এই লাইনটি চেক করুন

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable; // <--- এখানে HasApiTokens যুক্ত করুন

    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    //     'role', // আপনার প্রজেক্টে রোল থাকলে
    // ];
protected $fillable = [
    'name',
    'email',
    'phone',          // <--- নতুন
    'password',
    'profile_image',  // <--- নতুন
    'date_of_birth',  // <--- নতুন
    'gender',         // <--- নতুন
    'role',
];
    protected $hidden = [
        'password',
        'remember_token',
    ];
}