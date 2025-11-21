<?php

use App\Http\Controllers\HomeController;
use GuzzleHttp\Middleware;
use Illuminate\Notifications\Action;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;

Route::get('/', [HomeController::Class, 'index'])->name('home');
Route::redirect('/home', '/');

Route::get('/login', [AuthController::Class, 'login'])->name('login');
Route::get('/register', [AuthController::Class, 'register'])->name('register');
Route::post('/register', [AuthController::Class, 'postRegister'])->name('postRegister');
Route::post('/login', [AuthController::Class, 'postLogin'])->name('postLogin');
Route::post('/logout', [AuthController::Class, 'logout'])->name('logout');

Route::middleware('auth')->prefix('company')->name('company.')->group(function () {
    Route::get("/", [CompanyController::class, 'index'])->name('index');
    Route::get("/terms", [CompanyController::class, 'terms'])->name('terms');
    Route::post("/store", [CompanyController::class, 'store'])->name('store');
    
});
