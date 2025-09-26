<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/home', 'home')->name('home');
    Route::post('/logout', 'logout')->name('logout');
});

Route::resource('users', UserController::class)->middleware('auth');
Route::resource('products', \App\Http\Controllers\ProductController::class);
Route::resource('compras', \App\Http\Controllers\CompraController::class);
Route::get('/compra', [\App\Http\Controllers\CompraController::class, 'compra'])->name('compras.compra');
