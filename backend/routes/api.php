<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\V1\CompleteTaskController;
use App\Http\Controllers\Api\V1\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware('auth:sanctum')->group(function(){
    Route::apiResource('tasks', TaskController::class);
    Route::patch('tasks/{task}/complete', CompleteTaskController::class);
});
Route::apiResource('tasks', TaskController::class);
Route::patch('tasks/{task}/complete', CompleteTaskController::class);

Route::prefix('auth')->group(function() {
    Route::middleware('guest')->group(function(){
        Route::post('login', LoginController::class);
        Route::post('register', RegisterController::class);
    });
    Route::middleware('auth:sanctum')->group(function() {
        Route::delete('logout', LogoutController::class);
    });
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
