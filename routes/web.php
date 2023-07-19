<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\PasswordController;

Route::controller(MainController::class)->group(function () {
    Route::name('main.')->group(function () {
        Route::get('/','home')->name('home');
    });
});

Route::controller(AuthController::class)->group(function () {
    Route::name('auth.')->group(function () {
        Route::get('/login','login')->name('login');
        Route::get('/register','register')->name('register');
    });

    Route::post('/register','registerPOST');
    Route::post('/login','loginPOST');
});

Route::controller(PasswordController::class)->prefix('/password')->group(function () {
    Route::name('password.')->group(function () {
        Route::get('/forgot','forgot')->name('forgot');
        Route::get('/reset','reset')->name('reset');
    });

    Route::post('/forgot','forgotPOST');
    Route::post('/reset','resetPOST');
});

Route::controller(VerificationController::class)->prefix('/verification')->group(function () {
    Route::name('verification.')->group(function () {
        Route::get('/notice','notice')->name('notice');
        Route::get('/verify/{id}/{hash}','verify')->name('verify');
    });

    Route::post('/notice','noticePOST');
});

Route::controller(UserController::class)->prefix('/user')->group(function () {
    Route::name('user.')->group(function () {
        Route::get('/panel','panel')->name('panel');
        Route::get('/notifications','notifications')->name('notifications');
        Route::get('/create-post','createPost')->name('createPost');
        Route::post('/logout','logout')->name('logout');
    });

    Route::post('/panel','panelPOST');
});
