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

//swagger documentation
Route::get('api/documentation', '\L5Swagger\Http\Controllers\SwaggerController@api')->name('swagger.api');

//routes endpoints
Route::prefix('v1')->group(function () {
    require_once ('modules/book.php');
    require_once ('modules/category.php');
    require_once ('modules/utils.php');
});

require_once('modules/utils.php');
