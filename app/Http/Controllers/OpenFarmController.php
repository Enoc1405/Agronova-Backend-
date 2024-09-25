<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class OpenFarmController extends Controller
{
    public function obtenerPlanta($slug)
    {
        try {
            // Llamada a la API externa
            $response = Http::get("https://openfarm.cc/api/v1/crops/{$slug}");

            // Verifica si la respuesta es exitosa
            if ($response->successful()) {
                return response()->json($response->json());
            } else {
                return response()->json([
                    'error' => 'Error al obtener datos de la API externa',
                    'status_code' => $response->status()
                ], 500);
            }
        } catch (\Exception $e) {
            // Captura cualquier excepción y devuelve un error con el mensaje de la excepción
            return response()->json([
                'error' => 'Ocurrió un error inesperado al procesar la solicitud',
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ], 500);
        }
    }
}
