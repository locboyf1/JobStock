<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CompanyFavoriteController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobCompanyController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobPostSavedController;
use App\Http\Controllers\PostReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResumeController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\AuthPageMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::redirect('/home', '/');

Route::middleware(AuthPageMiddleware::class)->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'postRegister'])->name('postRegister');
    Route::post('/login', [AuthController::class, 'postLogin'])->name('postLogin');
    Route::get('/forget-password', [AuthController::class, 'forgetPassword'])->name('forgetPassword');
    Route::post('/forget-password', [AuthController::class, 'postForgetPassword'])->name('postForgetPassword');
    Route::get('/reset-password', [AuthController::class, 'resetPassword'])->name('resetPassword');
    Route::post('/reset-password', [AuthController::class, 'postResetPassword'])->name('postResetPassword');

    Route::get('auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback']);
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(AuthMiddleware::class)->prefix('company')->name('company.')->group(function () {
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
        Route::put('/status/{id}', [JobCompanyController::class, 'status'])->name('status');
    });
});

Route::prefix('companies')->name('companies.')->group(function () {
    Route::get('/', [CompaniesController::class, 'index'])->name('index');
    Route::get('/show/{id}', [CompaniesController::class, 'show'])->name('show');
    Route::post('/favorite/{id}', [CompaniesController::class, 'favorite'])->middleware(AuthMiddleware::class)->name('favorite');
});

Route::prefix('job')->name('job.')->group(function () {
    Route::get('/', [JobController::class, 'index'])->name('index');
    Route::get('/show/{id}', [JobController::class, 'show'])->name('show');
    Route::post('/save/{id}', [JobController::class, 'save'])->middleware(AuthMiddleware::class)->name('save');
});

Route::post('/report/{id}', [PostReportController::class, 'store'])->name('report');

Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/show/{id}/{alias}', [BlogController::class, 'show'])->name('show');
    Route::middleware(AuthMiddleware::class)->post('/comment/{blogId}', [BlogController::class, 'comment'])->name('comment');
});

Route::prefix('job-post-saved')->middleware(AuthMiddleware::class)->name('jobpostsaved.')->group(function () {
    Route::get('/', [JobPostSavedController::class, 'index'])->name('index');
    Route::delete('/unsave/{id}', [JobPostSavedController::class, 'destroy'])->name('destroy');
});

Route::prefix('company-favorite')->middleware(AuthMiddleware::class)->name('companyfavorite.')->group(function () {
    Route::get('/', [CompanyFavoriteController::class, 'index'])->name('index');
    Route::delete('/unfavorite/{id}', [CompanyFavoriteController::class, 'destroy'])->name('destroy');
});

Route::prefix('profile')->middleware(AuthMiddleware::class)->name('profile.')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::put('/update', [ProfileController::class, 'update'])->name('update');
    Route::put('/change-password', [ProfileController::class, 'changePassword'])->name('change-password');
});

Route::prefix('contact')->name('contact.')->group(function () {
    Route::get('/', [ContactController::class, 'index'])->name('index');
    Route::post('/store', [ContactController::class, 'store'])->name('store');
});

Route::prefix('resume')->name('resume.')->group(function () {
    Route::get('/create', [ResumeController::class, 'create'])->name('create');
});
