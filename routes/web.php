<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\UserController;

Route::get('/', function () {
    return view('welcome');
});

//Laravel's built-in authentication scaffolding, you don't need to define a login method in your LoginController
//Auth::routes();
// routes/web.php
Route::post('/verify', 'FingerprintController@verify');

Route::post('/verify-fingerprint', 'FingerprintVerificationController@verify');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [UserController::class, 'register'])->name('register');



Route::post('/fingerprint-login', [LoginController::class, 'fingerprintLogin'])->name('fingerprint.login');
