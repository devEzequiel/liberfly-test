<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//routes endpoints
Route::prefix('v1')->group(function () {
    require_once('modules/book.php');
    require_once('modules/category.php');
    require_once('modules/auth.php');
});

require_once('modules/utils.php');
