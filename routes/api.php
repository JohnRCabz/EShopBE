<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CartController;

// EShop Item API Routes
Route::get('/items', [ItemController::class, 'index']);
Route::post('/items', [ItemController::class, 'store']);
Route::get('/items/{id}', [ItemController::class, 'show']);
Route::put('/items/{id}', [ItemController::class, 'update']);
Route::delete('/items/{id}', [ItemController::class, 'destroy']);

// EShop Cart API Routes
Route::post('/cart', [CartController::class, 'add']);
Route::get('/cart', [CartController::class, 'view']);
Route::delete('/cart/{id}', [CartController::class, 'remove']);
Route::post('/cart/checkout', [CartController::class, 'checkout']);
