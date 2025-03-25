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
    Route::get('/{id}/show-ajax', [UserController::class, 'showAjax'])->name('users.show-ajax');
    Route::get('/{id}/update', [UserController::class, 'updatePage'])->name('users.update-page');
    Route::patch('/{id}/update', [UserController::class, 'update'])->name('users.update');
    Route::patch('/{id}/update-ajax', [UserController::class, 'updateAjax'])->name('users.update-ajax');
    Route::delete('/{id}/delete', [UserController::class, 'delete'])->name('users.delete');
    Route::delete('/{id}/delete-ajax', [UserController::class, 'deleteAjax'])->name('users.delete-ajax');
    Route::post('/store', [UserController::class, 'store'])->name('users.store');
    Route::post('/store-ajax', [UserController::class, 'storeAjax'])->name('users.store-ajax');
    
});
// Level Routes
Route::prefix('/levels')->group(function () {
    Route::get('', [LevelController::class, 'page'])->name('levels.page');
    Route::get('/list', [LevelController::class, 'list'])->name('levels.list');
    Route::get('/store', [LevelController::class, 'storePage'])->name('levels.store-page');
    Route::get('/{id}', [LevelController::class, 'show'])->name('levels.show');
    Route::get('/{id}/show-ajax', [LevelController::class, 'showAjax'])->name('levels.show-ajax');
    Route::get('/{id}/update', [LevelController::class, 'updatePage'])->name('levels.update-page');
    Route::patch('/{id}/update', [LevelController::class, 'update'])->name('levels.update');
    Route::patch('/{id}/update-ajax', [LevelController::class, 'updateAjax'])->name('levels.update-ajax');
    Route::delete('/{id}/delete', [LevelController::class, 'delete'])->name('levels.delete');
    Route::delete('/{id}/delete-ajax', [LevelController::class, 'deleteAjax'])->name('levels.delete-ajax');
    Route::post('/store', [LevelController::class, 'store'])->name('levels.store');
    Route::post('/store-ajax', [LevelController::class, 'storeAjax'])->name('levels.store-ajax');
});
// Category Routes
Route::prefix('/categories')->group(function () {
    Route::get('', [CategoryController::class, 'page'])->name('categories.page');
    Route::get('/list', [CategoryController::class, 'list'])->name('categories.list');
    Route::get('/store', [CategoryController::class, 'storePage'])->name('categories.store-page');
    Route::get('/{id}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/{id}/show-ajax', [CategoryController::class, 'showAjax'])->name('categories.show-ajax');
    Route::get('/{id}/update', [CategoryController::class, 'updatePage'])->name('categories.update-page');
    Route::patch('/{id}/update', [CategoryController::class, 'update'])->name('categories.update');
    Route::patch('/{id}/update-ajax', [CategoryController::class, 'updateAjax'])->name('categories.update-ajax');
    Route::delete('/{id}/delete', [CategoryController::class, 'delete'])->name('categories.delete');
    Route::delete('/{id}/delete-ajax', [CategoryController::class, 'deleteAjax'])->name('categories.delete-ajax');
    Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::post('/store-ajax', [CategoryController::class, 'storeAjax'])->name('categories.store-ajax');
});
// Item Routes
Route::prefix('/items')->group(function () {
    Route::get('', [ItemController::class, 'page'])->name('items.page');
    Route::get('/list', [ItemController::class, 'list'])->name('items.list');
    Route::get('/store', [ItemController::class, 'storePage'])->name('items.store-page');
    Route::get('/{id}', [ItemController::class, 'show'])->name('items.show');
    Route::get('/{id}/show-ajax', [ItemController::class, 'showAjax'])->name('items.show-ajax');
    Route::get('/{id}/update', [ItemController::class, 'updatePage'])->name('items.update-page');
    Route::patch('/{id}/update', [ItemController::class, 'update'])->name('items.update');
    Route::patch('/{id}/update-ajax', [ItemController::class, 'updateAjax'])->name('items.update-ajax');
    Route::delete('/{id}/delete', [ItemController::class, 'delete'])->name('items.delete');
    Route::delete('/{id}/delete-ajax', [ItemController::class, 'deleteAjax'])->name('items.delete-ajax');
    Route::post('/store', [ItemController::class, 'store'])->name('items.store');
    Route::post('/store-ajax', [ItemController::class, 'storeAjax'])->name('items.store-ajax');
});
// Stock Routes
Route::prefix('/stocks')->group(function () {
    Route::get('', [StockController::class, 'page'])->name('stocks.page');
    Route::get('/list', [StockController::class, 'list'])->name('stocks.list');
    Route::get('/store', [StockController::class, 'storePage'])->name('stocks.store-page');
    Route::get('/{id}', [StockController::class, 'show'])->name('stocks.show');
    Route::get('/{id}/show-ajax', [StockController::class, 'showAjax'])->name('stocks.show-ajax');
    Route::get('/{id}/update', [StockController::class, 'updatePage'])->name('stocks.update-page');
    Route::patch('/{id}/update', [StockController::class, 'update'])->name('stocks.update');
    Route::patch('/{id}/update-ajax', [StockController::class, 'updateAjax'])->name('stocks.update-ajax');
    Route::delete('/{id}/delete', [StockController::class, 'delete'])->name('stocks.delete');
    Route::delete('/{id}/delete-ajax', [StockController::class, 'deleteAjax'])->name('stocks.delete-ajax');
    Route::post('/store', [StockController::class, 'store'])->name('stocks.store');
    Route::post('/store-ajax', [StockController::class, 'storeAjax'])->name('stocks.store-ajax');
});