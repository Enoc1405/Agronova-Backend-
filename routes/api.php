<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstadisticaController;
use App\Http\Controllers\OpenFarmController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ConsultaController;

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

Route::apiResource('usuarios', UserController::class);
Route::post('/usuarios/login', [UserController::class, 'login']);
Route::get('/planta/{slug}', [OpenFarmController::class, 'obtenerPlanta']);
Route::apiResource('consultas', ConsultaController::class); // Rutas para consultas
Route::apiResource('estadisticas', EstadisticaController::class); // Rutas para estadísticas
Route::get('/test', function () {
    return response()->json(['message' => 'API is working!']);
});
