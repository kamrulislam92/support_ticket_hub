<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


// রেজিস্ট্রেশন পেজ ভিউ করার জন্য রুট
Route::get('/register', function () {
    return view('auth.registration'); // অথবা আপনার ব্লেড ফাইলের নাম ও লোকেশন অনুযায়ী
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/user/dashboard', function () {
    return view('user.dashboard');
});

