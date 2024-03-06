<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


use App\Http\Controllers\Auth\LoginController;
Route::post('/register', [UserController::class, 'register'])->name('register');

use App\Http\Controllers\Auth\UserController;
Route::post('/fingerprint-login', 'Auth\LoginController@fingerprintLogin')->name('fingerprint.login');


Route::post('/register', [UserController::class, 'register'])->name('register');

Route::post('/register', [UserController::class, 'register'])->name('register');
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');