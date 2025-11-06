<?php

use App\Http\Controllers\Admin\BlogCategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('blogcategory')->name('blogcategory.')->group(function () {
        Route::get('/', [BlogCategoryController::class, 'index'])->name('index');
        Route::get('/create', [BlogCategoryController::class, 'create'])->name('create');
        Route::post('/store', [BlogCategoryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [BlogCategoryController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [BlogCategoryController::class, 'update'])->name('update');
        Route::put('/status/{id}', [BlogCategoryController::class, 'status'])->name('status');
        Route::put('/up/{id}', [BlogCategoryController::class, 'up'])->name('up');
        Route::put('/down/{id}', [BlogCategoryController::class, 'down'])->name('down');
    });
});