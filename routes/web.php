<?php

use App\Http\Controllers\HomeController;
use Illuminate\Notifications\Action;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', [HomeController::Class, 'index']) -> name('home');
Route::redirect('/home', '/');

Route::get('/login', [AuthController::Class, 'login']) -> name('login');
Route::get('/register', [AuthController::Class, 'register']) -> name('register');