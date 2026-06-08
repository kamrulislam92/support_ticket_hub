<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/users', function (Request $request) {
    return $request->user();
});
/* LOGOUT API */
Route::post('/logout', [AuthController::class, 'logout']);