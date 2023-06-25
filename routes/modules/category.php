<?php

use Illuminate\Support\Facades\Route;

Route::controller(\App\Http\Controllers\V1\Category\CategoryController::class)
    ->middleware('auth:sanctum')
    ->name('categories.')
    ->prefix('categories')
    ->group(function () {
        Route::get('/', 'list')->name('list');
        Route::post('/', 'store')->name('create');
    });
