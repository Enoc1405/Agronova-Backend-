<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Estadisticas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultaController extends Controller
{
    // Listar todas las consultas
    public function index()
    {
        try {
            // Obtener todas las consultas
            $consultas = Consulta::all();
            return response()->json($consultas, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener las consultas: ' . $e->getMessage()], 500);
        }
    }

    // Mostrar una consulta específica por ID
    public function show($id)
    {
        try {
            // Buscar la consulta por ID
            $consulta = Consulta::findOrFail($id);
            return response()->json($consulta, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Consulta no encontrada: ' . $e->getMessage()], 404);
        }
    }

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

            // Actualizar estadísticas
            $userId = $request->input('user_id');
            $estadistica = Estadisticas::firstOrCreate(
                ['user_id' => $userId], // Si no existe, se crea una nueva fila
                ['numero_consultas' => 0, 'temas_mas_consultados' => '']
            );

            // Incrementar el número de consultas
            $estadistica->increment('numero_consultas');

            // Actualizar los temas más consultados (esto depende de cómo manejas los temas)
            $temaActual = $consulta->consulta_texto;
            $temasAnteriores = $estadistica->temas_mas_consultados;
            $estadistica->update([
                'temas_mas_consultados' => $temasAnteriores ? $temasAnteriores . ', ' . $temaActual : $temaActual
            ]);

            return response()->json($consulta, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear la consulta: ' . $e->getMessage()], 500);
        }
    }

    // Actualizar una consulta existente
    public function update(Request $request, $id)
    {
        try {
            $consulta = Consulta::findOrFail($id);

            $request->validate([
                'consulta_texto' => 'required|string',
                'fecha' => 'nullable|date',
            ]);

            // Actualizar la consulta con los nuevos datos
            $consulta->update($request->only(['consulta_texto', 'fecha']));

            return response()->json($consulta, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar la consulta: ' . $e->getMessage()], 500);
        }
    }

    // Eliminar una consulta
    public function destroy($id)
    {
        try {
            $consulta = Consulta::findOrFail($id);
            $consulta->delete();

            return response()->json(['message' => 'Consulta eliminada correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar la consulta: ' . $e->getMessage()], 500);
        }
    }
}
