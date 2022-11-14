<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('types')->as('types.')->group(function() {
        Route::get('/', \App\Http\Controllers\Api\Types\IndexController::class)->name('index');
        Route::post('/store', App\Http\Controllers\Api\Types\StoreController::class)->name('store');
        Route::get('{uuid}', App\Http\Controllers\Api\Types\ShowController::class)->name('show');
        Route::put('{uuid}', App\Http\Controllers\Api\Types\UpdateController::class)->name('update');
    });
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});