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

Route::post('/register', \App\Http\Controllers\Api\RegisterController::class)->name('register');

Route::post('/login', \App\Http\Controllers\Api\LoginController::class)->name('login');


Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('auth')->as('auth.')->group(function() {
        Route::post('/revoke/{uuid}', App\Http\Controllers\Api\Auth\RevokeController::class)->name('revoke');
    });

    Route::prefix('users')->as('users.')->group(function() {
        Route::get('/', App\Http\Controllers\Api\Users\IndexController::class)->name('index');

        Route::middleware('verify.user.uuid')->group(function() {
            Route::get('/{uuid}', App\Http\Controllers\Api\Users\ShowController::class)->name('show');
            Route::put('/{uuid?}', App\Http\Controllers\Api\Users\UpdateController::class)->name('update');
            Route::delete('/{uuid?}', App\Http\Controllers\Api\Users\DestroyController::class)->name('destroy');
        });
    });

    Route::prefix('types')->as('types.')->group(function() {
        Route::get('/', \App\Http\Controllers\Api\Types\IndexController::class)->name('index');
        Route::post('/store', App\Http\Controllers\Api\Types\StoreController::class)->name('store');
        Route::get('{uuid}', App\Http\Controllers\Api\Types\ShowController::class)->name('show');
        Route::put('{uuid}', App\Http\Controllers\Api\Types\UpdateController::class)->name('update');
        Route::delete('{uuid}', App\Http\Controllers\Api\Types\DestroyController::class)->name('destroy');
    });

    Route::prefix('subjects')->as('subjects.')->group(function() {
        Route::post('/', \App\Http\Controllers\Api\Subjects\StoreController::class)->name('store');
    });
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});