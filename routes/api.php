<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlantController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('plants', PlantController::class);

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::put('/users/{user}/role', [UserController::class, 'updateRole']);
});



