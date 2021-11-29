<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RequestHdrController;
use App\Http\Controllers\RequestDtlController;

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

Route::middleware('api')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('locations', LocationController::class);
    Route::resource('products', ProductController::class);
    Route::resource('request_hdrs', RequestHdrController::class);
    Route::resource('request_dtls', RequestDtlController::class);
    
});
