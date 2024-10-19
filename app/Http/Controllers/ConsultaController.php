<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Estadisticas;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    // Crear una nueva consulta
    public function store(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required|exists:users,id',  // Valida que el usuario exista
                'consulta_texto' => 'required|string',
                'fecha' => 'nullable|date',
            ], [
                'user_id.required' => 'El campo usuario es obligatorio.',
                'user_id.exists' => 'El usuario no existe en el sistema.',
                'consulta_texto.required' => 'El texto de la consulta es obligatorio.',
                'fecha.date' => 'La fecha debe tener un formato válido (YYYY-MM-DD).',
            ]);

            // Crear la consulta
            $consulta = Consulta::create($request->only([
                'user_id', 'consulta_texto', 'fecha'  // Solo los campos relevantes
            ]));

            // Actualizar las estadísticas
            $estadisticas = Estadisticas::firstOrCreate(
                ['user_id' => $request->user_id],  // Buscar las estadísticas por user_id
                [ // Valores por defecto si no existen
                    'numero_consultas' => 0,
                    'temas_mas_consultados' => '',
                    'satisfaccion_usuario' => 0,
                ]
            );

            // Actualizar el número de consultas
            $estadisticas->numero_consultas += 1;
            
            // Actualizar los temas más consultados (ejemplo simple)
            $estadisticas->temas_mas_consultados = $consulta->consulta_texto;  // Aquí podrías añadir lógica para manejar múltiples temas

            // Guardar las actualizaciones en la tabla de estadísticas
            $estadisticas->save();

            return response()->json($consulta, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear la consulta: ' . $e->getMessage()], 500);
        }
    }
}
