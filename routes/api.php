<?php
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Ruta Pública (Login)
Route::post('/login', [AuthController::class, 'login']);

// Rutas Protegidas (CRUD de Usuarios y Logout)
Route::middleware('auth:sanctum')->group(function () {
    // Ruta de logout
    Route::post('/logout', [AuthController::class, 'logout']);


// 1. DEFINICIÓN MANUAL DE LA RUTA DE CREACIÓN (POST)
    // Esto resuelve el conflicto de ruteo que ocurre con apiResource en el grupo protegido.
    Route::post('/usuarios', [UserController::class, 'store'])->name('usuarios.store');

    // 2. Definir las rutas REST restantes, EXCLUYENDO 'store'
    Route::apiResource('usuarios', UserController::class)->except(['store']);
});