<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

// Test API route
Route::get('/ping', fn() => response()->json(['message' => 'pong']));

Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'list'])->name('categories.list');
    Route::post('/', [CategoryController::class, 'create'])->name('categories.create');
    Route::put('/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/{category}', [CategoryController::class, 'delete'])->name('categories.delete');
});

route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'list'])->name('products.list');
    Route::post('/', [ProductController::class, 'create'])->name('products.create');
    Route::put('/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/{product}', [ProductController::class, 'delete'])->name('products.delete');
});