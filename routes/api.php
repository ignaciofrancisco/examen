<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ClientController;



// Rutas públicas (login)
Route::post('/login', [AuthController::class, 'login']);

// Rutas protegidas por token
Route::middleware('auth:sanctum')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);

    // Usuarios
    Route::get('/users', [UserController::class, 'index']);      
    Route::get('/users/{user}', [UserController::class, 'show']); 
    Route::post('/users', [UserController::class, 'store']);      
    Route::put('/users/{user}', [UserController::class, 'update']); 
    Route::delete('/users/{user}', [UserController::class, 'destroy']);

    // Productos
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{product}', [ProductController::class, 'show']);
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{product}', [ProductController::class, 'update']);
    Route::delete('/products/{product}', [ProductController::class, 'destroy']);

    // Clientes
    Route::get('/clients', [ClientController::class, 'index']);
    Route::get('/clients/{client}', [ClientController::class, 'show']);
    Route::post('/clients', [ClientController::class, 'store']);
    Route::put('/clients/{client}', [ClientController::class, 'update']);
    Route::delete('/clients/{client}', [ClientController::class, 'destroy']);
});
