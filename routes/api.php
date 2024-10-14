<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstadisticaController;
use App\Http\Controllers\OpenFarmController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\ChatbotController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::prefix('usuarios')->group(function () {
    Route::get('/', [UserController::class, 'index']); // Mostrar todos los usuarios
    Route::get('/{id}', [UserController::class, 'show']); // Mostrar un usuario específico
    Route::post('/', [UserController::class, 'store']); // Crear un nuevo usuario
    Route::put('/{id}', [UserController::class, 'update']); // Actualizar un usuario existente
    Route::delete('/{id}', [UserController::class, 'destroy']); // Eliminar un usuario
    Route::post('/{id}/assign-role', [UserController::class, 'assignRole']); // Asignar un rol a un usuario
    Route::get('/{id}/roles', [UserController::class, 'showRoles']); // Mostrar los roles de un usuario
});

Route::post('/usuarios/login', [UserController::class, 'login']);
Route::get('/planta/{slug}', [OpenFarmController::class, 'obtenerPlanta']);
Route::apiResource('consultas', ConsultaController::class); // Rutas para consultas
Route::apiResource('estadisticas', EstadisticaController::class); // Rutas para estadísticas
Route::post('/conversations', [ChatbotController::class, 'sendMessage']);
Route::get('/test', function () {
    return response()->json(['message' => 'API is working!']);
});
