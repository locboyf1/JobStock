<?php

use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CompanyJobController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\JobGroupController;

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

    Route::prefix('blog')->name('blog.')->group(function () {
        Route::get('/', [BlogController::class, 'index'])->name('index');
        Route::get('/create', [BlogController::class, 'create'])->name('create');
        Route::post('/store', [BlogController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [BlogController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [BlogController::class, 'update'])->name('update');
        Route::put('/status/{id}', [BlogController::class, 'status'])->name('status');
    });

    Route::prefix('jobgroup')->name('jobgroup.')->group(function () {
        Route::get('/', [JobGroupController::class, 'index'])->name('index');
        Route::get('/create', [JobGroupController::class, 'create'])->name('create');
        Route::post('/store', [JobGroupController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [JobGroupController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [JobGroupController::class, 'update'])->name('update');
        Route::put('/status/{id}', [JobGroupController::class, 'status'])->name('status');
        Route::put('/up/{id}', [JobGroupController::class, 'up'])->name('up');
        Route::put('/down/{id}', [JobGroupController::class, 'down'])->name('down');
    });

    Route::prefix('job')->name('job.')->group(function () {
        Route::get('/{id}', [JobController::class, 'index'])->name('index');
        Route::get('/create/{id}', [JobController::class, 'create'])->name('create');
        Route::post('/store/{id}', [JobController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [JobController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [JobController::class, 'update'])->name('update');
        Route::put('/status/{id}', [JobController::class, 'status'])->name('status');
        Route::put('/up/{id}', [JobController::class, 'up'])->name('up');
        Route::put('/down/{id}', [JobController::class, 'down'])->name('down');
    });
});
