<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome'); // carrega o menu customizado
});

// se ainda não tiver, garanta que suas rotas de compras estão assim:
Route::resource('products', \App\Http\Controllers\ProductController::class);
Route::resource('compras', \App\Http\Controllers\CompraController::class);
Route::get('/compra', [\App\Http\Controllers\CompraController::class, 'compra'])->name('compras.compra');
