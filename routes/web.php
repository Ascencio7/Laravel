<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Lo primero que ve el usuario es el login
Route::get('/', function () {
    return redirect()->route('login');
});

// Solo para usuarios NO autenticados
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister']);
    Route::post('/register', [AuthController::class, 'register']);
});

// Solo para usuarios autenticados
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Productos
    Route::get('/products/show', [ProductController::class, 'index']);
    Route::get('/products/create', [ProductController::class, 'create']);
    Route::get('/products/edit/{producto}', [ProductController::class, 'edit']);
    Route::post('/products/store', [ProductController::class, 'store']);
    Route::put('/products/update/{producto}', [ProductController::class, 'update']);
    Route::delete('/products/destroy/{producto}', [ProductController::class, 'destroy']);

    // Usuarios
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/create', [UserController::class, 'create']);
    Route::post('/users/store', [UserController::class, 'store']);
    Route::get('/users/edit/{usuario}', [UserController::class, 'edit']);
    Route::put('/users/update/{usuario}', [UserController::class, 'update']);
    Route::delete('/users/destroy/{usuario}', [UserController::class, 'destroy']);
});