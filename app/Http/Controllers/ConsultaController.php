<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    // Mostrar todas las consultas
    public function index()
    {
        $consultas = Consulta::all();
        return response()->json($consultas);
    }

    // Mostrar una consulta específica
    public function show($id)
    {
        $consulta = Consulta::findOrFail($id);
        return response()->json($consulta);
    }

    // Crear una nueva consulta
    public function store(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required|exists:users,id',  // Cambiado aquí
                'consulta_texto' => 'required|string',
                'respuesta_texto' => 'nullable|string',
                'fecha' => 'nullable|date',
            ], [
                'user_id.required' => 'El campo usuario es obligatorio.',  // Cambiado aquí
                'user_id.exists' => 'El usuario no existe en el sistema.',  // Cambiado aquí
                'consulta_texto.required' => 'El texto de la consulta es obligatorio.',
                'fecha.date' => 'La fecha debe tener un formato válido (YYYY-MM-DD).',
            ]);

            // Crear la consulta con solo los campos permitidos
            $consulta = Consulta::create($request->only([
                'user_id', 'consulta_texto', 'respuesta_texto', 'fecha'  // Cambiado aquí
            ]));

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
                'user_id' => 'required|exists:users,id',  // Cambiado aquí
                'consulta_texto' => 'required|string',
                'respuesta_texto' => 'nullable|string',
                'fecha' => 'nullable|date',
            ], [
                'user_id.required' => 'El campo usuario es obligatorio.',  // Cambiado aquí
                'user_id.exists' => 'El usuario no existe en el sistema.',  // Cambiado aquí
                'consulta_texto.required' => 'El texto de la consulta es obligatorio.',
                'fecha.date' => 'La fecha debe tener un formato válido (YYYY-MM-DD).',
            ]);

            // Actualizar la consulta con solo los campos permitidos
            $consulta->update($request->only([
                'user_id', 'consulta_texto', 'respuesta_texto', 'fecha'  // Cambiado aquí
            ]));

            return response()->json($consulta);
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
            return response()->json(['message' => 'Consulta eliminada con éxito'], 204);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar la consulta: ' . $e->getMessage()], 500);
        }
    }
}
