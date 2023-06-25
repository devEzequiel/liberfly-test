<?php

use Illuminate\Support\Facades\Route;

Route::controller(\App\Http\Controllers\V1\Auth\AuthController::class)
    ->name('auth.')
    ->group(function () {
        Route::post('/login', 'postLogin')->name('login');
        Route::post('/signup', 'postSignUp')->name('signup');
    });
