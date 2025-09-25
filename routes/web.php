<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome'); // carrega o menu customizado
});

// se ainda não tiver, garanta que suas rotas de produtos estão assim:
Route::resource('products', \App\Http\Controllers\ProductController::class);
Route::resource('produtos', \App\Http\Controllers\ProdutoController::class);
Route::get('/compra', [\App\Http\Controllers\ProdutoController::class, 'compra'])->name('produtos.compra');
