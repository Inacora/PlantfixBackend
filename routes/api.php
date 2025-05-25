<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return response()->json([
        'id' => $request->user()->id,
        'name' => $request->user()->name,
        'email' => $request->user()->email,
        'role' => $request->user()->role,
    ]);
});

// Solo auth:sanctum, y en el middleware de la ruta controlamos si es admin o el propio usuario
Route::middleware(['auth:sanctum'])->group(function () {
    Route::put('users/{user}', [UserController::class, 'update'])->middleware('own.user');
    Route::patch('users/{user}', [UserController::class, 'update'])->middleware('own.user');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->middleware('own.user');
    Route::get('plants', [PlantController::class, 'index']);
    Route::post('orders', [OrderController::class, 'store']);

    // Rutas que solo admins pueden acceder (añadimos middleware admin)
    Route::middleware('admin')->group(function () {
        Route::get('users', [UserController::class, 'index']);
        Route::post('users', [UserController::class, 'store']);
        Route::get('users/{user}', [UserController::class, 'show']);

        Route::get('orders', [OrderController::class, 'index']);
        Route::get('orders/{order}', [OrderController::class, 'show']);
        Route::put('orders/{order}', [OrderController::class, 'update']);
        Route::patch('orders/{order}', [OrderController::class, 'update']);
        Route::delete('orders/{order}', [OrderController::class, 'destroy']);
        Route::patch('orders/{id}/status', [OrderController::class, 'updateStatus']);

        Route::post('plants', [PlantController::class, 'store']);
        Route::get('plants/{plant}', [PlantController::class, 'show']);
        Route::put('plants/{plant}', [PlantController::class, 'update']);
        Route::patch('plants/{plant}', [PlantController::class, 'update']);
        Route::delete('plants/{plant}', [PlantController::class, 'destroy']);

        Route::get('plants/search', [PlantController::class, 'search']);

        Route::get('users/search', [UserController::class, 'search']);
        Route::get('orders/search', [OrderController::class, 'search']);

        Route::get('orders/{id}/user', [OrderController::class, 'getUserByOrder']);
    });
});
