<?php

use Illuminate\Support\Facades\Route;

Route::controller(\App\Http\Controllers\V1\UtilsController::class)
    ->name('utils.')
    ->group(function () {
        Route::get('/health-check', 'healthCheck')->name('check');
    });
