<?php

use Illuminate\Support\Facades\Route;

Route::controller(\App\Http\Controllers\V1\Book\BookController::class)
    ->name('books.')
    ->prefix('books')
    ->group(function () {
        Route::get('/', 'all')->name('list');
        Route::get('/{id}', 'show')->name('detail');
        Route::post('/', 'store')->name('create');
    });
