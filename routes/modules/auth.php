<?php

use Illuminate\Support\Facades\Route;

Route::controller(\App\Http\Controllers\Api\Auth\AuthController::class)
    ->name('auth.')
    ->group(function () {
        Route::get('/login', 'postAuth')->name('login');
        Route::get('/signup', 'healthCheck')->name('signup');
    });
