<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['middleware' => ['guest']], function () {
    Route::post('/authenticate', \App\Http\Controllers\Api\LoginController::class);
    Route::post('/register', [RegisterController::class, 'store']);
});


Route::middleware('auth')->group(function () {
    Route::get('/me', \App\Http\Controllers\Api\MeController::class);
    Route::post('/verify', [RegisterController::class, 'update']);


    Route::prefix('products')->group(function () {
        Route::get('/', [\App\Http\Controllers\ProductController::class, 'index']);
        Route::get('/search', [\App\Http\Controllers\ProductController::class, 'searchProductName']);
    });
});
