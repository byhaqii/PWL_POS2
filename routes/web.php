<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// User Routes
Route::prefix('/users')->group(function () {
    Route::get('', [UserController::class, 'page'])->name('users.page');
    Route::get('/list', [UserController::class, 'list'])->name('users.list');
    Route::get('/store', [UserController::class, 'storePage'])->name('users.store-page');
    Route::get('/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('/{id}/update', [UserController::class, 'updatePage'])->name('users.update-page');
    Route::patch('/{id}/update', [UserController::class, 'update'])->name('users.update');
    Route::delete('/{id}/delete', [UserController::class, 'delete'])->name('users.delete');
    Route::post('/store', [UserController::class, 'store'])->name('users.store');
    Route::get('user/create_ajax', [UserController::class, 'create_ajax']);
    Route::post('user/store_ajax', [UserController::class, 'store_ajax']);
    
});
// Level Routes
Route::prefix('/levels')->group(function () {
    Route::get('', [LevelController::class, 'page'])->name('levels.page');
    Route::get('/list', [LevelController::class, 'list'])->name('levels.list');
    Route::get('/store', [LevelController::class, 'storePage'])->name('levels.store-page');
    Route::get('/{id}', [LevelController::class, 'show'])->name('levels.show');
    Route::get('/{id}/update', [LevelController::class, 'updatePage'])->name('levels.update-page');
    Route::patch('/{id}/update', [LevelController::class, 'update'])->name('levels.update');
    Route::delete('/{id}/delete', [LevelController::class, 'delete'])->name('levels.delete');
    Route::post('/store', [LevelController::class, 'store'])->name('levels.store');
});
// Category Routes
Route::prefix('/categories')->group(function () {
    Route::get('', [CategoryController::class, 'page'])->name('categories.page');
    Route::get('/list', [CategoryController::class, 'list'])->name('categories.list');
    Route::get('/store', [CategoryController::class, 'storePage'])->name('categories.store-page');
    Route::get('/{id}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/{id}/update', [CategoryController::class, 'updatePage'])->name('categories.update-page');
    Route::patch('/{id}/update', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/{id}/delete', [CategoryController::class, 'delete'])->name('categories.delete');
    Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
});
// Item Routes
Route::prefix('/items')->group(function () {
    Route::get('', [ItemController::class, 'page'])->name('items.page');
    Route::get('/list', [ItemController::class, 'list'])->name('items.list');
    Route::get('/store', [ItemController::class, 'storePage'])->name('items.store-page');
    Route::get('/{id}', [ItemController::class, 'show'])->name('items.show');
    Route::get('/{id}/update', [ItemController::class, 'updatePage'])->name('items.update-page');
    Route::patch('/{id}/update', [ItemController::class, 'update'])->name('items.update');
    Route::delete('/{id}/delete', [ItemController::class, 'delete'])->name('items.delete');
    Route::post('/store', [ItemController::class, 'store'])->name('items.store');
});
// Stock Routes
Route::prefix('/stocks')->group(function () {
    Route::get('', [StockController::class, 'page'])->name('stocks.page');
    Route::get('/list', [StockController::class, 'list'])->name('stocks.list');
    Route::get('/store', [StockController::class, 'storePage'])->name('stocks.store-page');
    Route::get('/{id}', [StockController::class, 'show'])->name('stocks.show');
    Route::get('/{id}/update', [StockController::class, 'updatePage'])->name('stocks.update-page');
    Route::patch('/{id}/update', [StockController::class, 'update'])->name('stocks.update');
    Route::delete('/{id}/delete', [StockController::class, 'delete'])->name('stocks.delete');
    Route::post('/store', [StockController::class, 'store'])->name('stocks.store');
});
