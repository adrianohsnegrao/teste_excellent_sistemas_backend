<?php

use App\Http\Controllers\ImagesController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'products'], function () {
    // Listar todos os produtos
    Route::get('/', [ProductController::class, 'index']);

    // Criar um novo produto
    Route::post('/', [ProductController::class, 'store']);

    // Exibir um único produto
    Route::get('/{product}', [ProductController::class, 'show']);

    // Atualizar um produto
    Route::put('/{product}', [ProductController::class, 'update']);

    // Deletar um produto
    Route::delete('/{product}', [ProductController::class, 'destroy']);
});

Route::group(['prefix' => 'orders'], function () {
    // Listar todos os perdidos
    Route::get('/', [OrderController::class, 'index']);

    // Criar um novo produto
    Route::post('/', [OrderController::class, 'store']);

    // Exibir um único produto
    Route::get('/{order}', [OrderController::class, 'show']);

    // Atualizar um produto
    Route::put('/{order}', [OrderController::class, 'update']);

    // Deletar um produto
    Route::delete('/{order}', [OrderController::class, 'destroy']);
});

Route::group(['prefix' => 'images'], function () {
    
    // Upload de imagem
    Route::post('/upload', [ImagesController::class, 'upload']);

    // Deletar imagem
    Route::delete('/{filename}', [ImagesController::class, 'delete']);
});