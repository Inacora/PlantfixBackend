<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();

    Route::apiResource('plants', PlantController::class);

    Route::apiResource('users', UserController::class);
});

Route::post('users/create', [UserController::class, 'create'])->name('users.create');

 