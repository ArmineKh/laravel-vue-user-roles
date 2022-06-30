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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();

// });

Route::post('register', [App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('login', [App\Http\Controllers\Api\AuthController::class, 'login']);

Route::middleware(['auth:api'])->group(function () {
    Route::middleware(['role:user'])->group(function () {
        Route::post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
        Route::get('/users', [App\Http\Controllers\UserController::class, 'index']);
    });

    Route::middleware(['role:admin'])->group(function () {
        Route::post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
        Route::get('/users', [App\Http\Controllers\UserController::class, 'index']);
        Route::post('/create', [App\Http\Controllers\UserController::class, 'store']);
    });

    Route::middleware(['role:admin'])->group(function () {
        Route::post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
        Route::get('/users', [App\Http\Controllers\UserController::class, 'index']);
        Route::post('/create', [App\Http\Controllers\UserController::class, 'store']);
        Route::delete('/users/{id}', [App\Http\Controllers\UserController::class, 'destroy']);
    });

});



