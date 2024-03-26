<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        return view('home');
    })->name('home');
    Route::get('/logout', [AuthController::class, 'logOut'])->name('logout');
});

Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);
Route::get('/login/apple', [AuthController::class, 'redirectToApple'])->name('login.apple');
Route::get('/login/apple/callback', [AuthController::class, 'handleAppleCallback']);
