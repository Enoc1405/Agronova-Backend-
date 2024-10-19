<?php

namespace App\Http\Controllers;

use App\Models\Estadisticas;
use Illuminate\Http\Request;

class EstadisticaController extends Controller
{
    // Mostrar todas las estadísticas
    public function index()
    {
        $estadisticas = Estadisticas::paginate(10); // Paginación para 10 estadísticas por página
        return response()->json($estadisticas);
    }

    // Mostrar una estadística específica
    public function show($id)
    {
        $estadistica = Estadisticas::findOrFail($id);
        return response()->json($estadistica);
    }

    // Crear una nueva estadística
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'numero_consultas' => 'required|integer',
            'temas_mas_consultados' => 'nullable|string',
            'satisfaccion_usuario' => 'required|integer|min:1|max:5',
        ]);

        $estadistica = Estadisticas::create($request->only([
            'user_id',
            'numero_consultas',
            'temas_mas_consultados',
            'satisfaccion_usuario'
        ]));

        return response()->json($estadistica, 201);
    }

    // Actualizar una estadística existente
    public function update(Request $request, $id)
    {
        $estadistica = Estadisticas::findOrFail($id);
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'numero_consultas' => 'required|integer',
            'temas_mas_consultados' => 'nullable|string',
            'satisfaccion_usuario' => 'required|integer|min:1|max:5',
        ]);

        $estadistica->update($request->only([
            'user_id',
            'numero_consultas',
            'temas_mas_consultados',
            'satisfaccion_usuario'
        ]));

        return response()->json($estadistica);
    }

    // Eliminar una estadística
    public function destroy($id)
    {
        $estadistica = Estadisticas::findOrFail($id);
        $estadistica->delete();
        return response()->json(null, 204);
    }
}
