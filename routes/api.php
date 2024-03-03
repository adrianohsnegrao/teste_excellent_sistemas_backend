<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Listar todos os produtos
Route::get('/products', [ProductController::class, 'index']);

// Criar um novo produto
Route::post('/products', [ProductController::class, 'store']);

// Exibir um único produto
Route::get('/products/{product}', [ProductController::class, 'show']);

// Atualizar um produto
Route::put('/products/{product}', [ProductController::class, 'update']);

// Deletar um produto
Route::delete('/products/{product}', [ProductController::class, 'destroy']);