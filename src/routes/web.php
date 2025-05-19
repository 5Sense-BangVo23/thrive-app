<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;

Route::get('/', fn () => view('welcome'));

// ======================= ADMIN ROUTES =======================

// Dashboard
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('dashboard', AdminHomeController::class)->only(['index']);

    // Category routes
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [AdminCategoryController::class, 'list'])->name('list');
        Route::get('create', [AdminCategoryController::class, 'create'])->name('create');
        Route::post('create', [AdminCategoryController::class, 'store'])->name('store');
        
        Route::get('edit/{id}', [AdminCategoryController::class, 'edit'])->name('edit');
        Route::put('{id}', [AdminCategoryController::class, 'update'])->name('update');

        Route::get('detail/{id}', [AdminCategoryController::class, 'view'])->name('detail');
        Route::delete('delete/{id}', [AdminCategoryController::class, 'detroy'])->name('delete');

        // Optional redirect
        Route::get('list', fn () => redirect()->route('admin.categories'));
    });

    // Product routes
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', [AdminProductController::class, 'list'])->name('list');
        Route::get('create', [AdminProductController::class, 'create'])->name('create');
        Route::get('edit/{id}', [AdminProductController::class, 'edit'])->name('edit');
        Route::get('detail/{id}', [AdminProductController::class, 'view'])->name('detail');
        Route::delete('delete/{id}', [AdminProductController::class, 'destroy'])->name('delete');

        // Optional redirect
        Route::get('list', fn () => redirect()->route('admin.products'));
    });
});
