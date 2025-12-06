<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobCompanyController;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::redirect('/home', '/');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'postRegister'])->name('postRegister');
Route::post('/login', [AuthController::class, 'postLogin'])->name('postLogin');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->prefix('company')->name('company.')->group(function () {
    Route::get('/', [CompanyController::class, 'index'])->name('index');
    Route::get('/terms', [CompanyController::class, 'terms'])->name('terms');
    Route::post('/store', [CompanyController::class, 'store'])->name('store');
    Route::get('/edit', [CompanyController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [CompanyController::class, 'update'])->name('update');

    Route::prefix('job')->name('job.')->group(function () {
        Route::get('/', [JobCompanyController::class, 'index'])->name('index');
        Route::get('/create', [JobCompanyController::class, 'create'])->name('create');
        Route::post('/store', [JobCompanyController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [JobCompanyController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [JobCompanyController::class, 'update'])->name('update');
    });

});

Route::prefix('job')->name('job.')->group(function () {
    Route::get('/', [JobController::class, 'index'])->name('index');
    Route::get('/show/{id}', [JobController::class, 'show'])->name('show');
});
