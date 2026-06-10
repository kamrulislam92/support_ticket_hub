<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


// পাবলিক রুট (লগইন করার জন্য কোনো টোকেন লাগে না)
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']); 

// প্রোটেক্টেড রুট (লগআউট এবং ইউজার ডেটার জন্য টোকেন বাধ্যতামূলক)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users', function (Request $request) {
        return $request->user();
    });
    
    Route::post('/logout', [AuthController::class, 'logout']);
});
