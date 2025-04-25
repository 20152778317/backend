<?php

/**
 * @OA\PathItem(
 *     path="/api"
 * )
 */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\HabitacionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;


// Rutas para autenticación
Route::post('register', [AuthController::class, 'register']);  // Registro de usuario
Route::post('login', [AuthController::class, 'login']);        // Login de usuario
Route::post('/logout', [AuthController::class, 'logout']);


// Ruta para obtener datos del usuario autenticado
Route::middleware('auth:sanctum')->get('/user', [UserController::class, 'getUser']);  // Ruta protegida para obtener el usuario autenticado

// Ruta para Swagger UI
Route::get('/api/documentation', function () {
    return view('swagger.index');  // Swagger UI se mostrará en esta ruta
});

// Rutas protegidas con Sanctum
Route::middleware('auth:sanctum')->group(function () {

    // CRUD de Hoteles
    Route::post('hoteles', [HotelController::class, 'store']);    // Crear hotel
    Route::get('hoteles', [HotelController::class, 'index']);     // Listar hoteles
    Route::get('hoteles/{id}', [HotelController::class, 'show']);  // Ver un hotel
    Route::put('hoteles/{id}', [HotelController::class, 'update']); // Actualizar hotel
    Route::delete('hoteles/{id}', [HotelController::class, 'destroy']); // Eliminar hotel

    // CRUD de Habitaciones
    Route::post('habitaciones', [HabitacionController::class, 'store']);  // Crear habitación
    Route::get('habitaciones', [HabitacionController::class, 'index']);   // Listar habitaciones
    Route::get('habitaciones/{id}', [HabitacionController::class, 'show']); // Ver una habitación
    Route::put('habitaciones/{id}', [HabitacionController::class, 'update']); // Actualizar habitación
    Route::delete('habitaciones/{id}', [HabitacionController::class, 'destroy']); // Eliminar habitación
});

