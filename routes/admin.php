<?php

use App\Http\Controllers\Admin\BlogCategoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::prefix('blogcategory')->name('blogcategory.')->group(function () {
        Route::get('/', [BlogCategoryController::class, 'index'])->name('index');
        Route::get('/create', [BlogCategoryController::class, 'create'])->name('create');
        Route::post('/store', [BlogCategoryController::class, 'store'])->name('store');


    });
});