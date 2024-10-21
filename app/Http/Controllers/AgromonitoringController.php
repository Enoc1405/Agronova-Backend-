<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AgromonitoringController extends Controller
{
    protected $apiUrl = 'http://api.agromonitoring.com/agro/1.0';
    protected $appId;

    public function __construct()
    {
        // Cargar la API Key desde .env
        $this->appId = env('AGRO_MONITORING_API_KEY'); 
    }

    // Crear un nuevo polígono
    public function createPolygon(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'geo_json' => 'required|array'
        ]);

        $response = Http::post($this->apiUrl . '/polygons?appid=' . $this->appId, [
            'name' => $request->name,
            'geo_json' => $request->geo_json,
        ]);

        return response()->json($response->json(), $response->status());
    }

    // Obtener un polígono por su ID
    public function getPolygon($id)
    {
        $response = Http::get($this->apiUrl . '/polygons/' . $id . '?appid=' . $this->appId);

        return response()->json($response->json(), $response->status());
    }

    // Actualizar un polígono
    public function updatePolygon(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $response = Http::put($this->apiUrl . '/polygons/' . $id . '?appid=' . $this->appId, [
            'name' => $request->name,
        ]);

        return response()->json($response->json(), $response->status());
    }

    // Eliminar un polígono
    public function deletePolygon($id)
    {
        $response = Http::delete($this->apiUrl . '/polygons/' . $id . '?appid=' . $this->appId);

        return response()->json($response->json(), $response->status());
    }

    // Listar todos los polígonos
    public function listPolygons()
    {
        $response = Http::get($this->apiUrl . '/polygons?appid=' . $this->appId);

        return response()->json($response->json(), $response->status());
    }

    // Método para obtener datos meteorológicos actuales
    public function getCurrentWeather(Request $request)
    {
        $lat = $request->query('lat');
        $lon = $request->query('lon');

        // Validar la entrada
        if (!$lat || !$lon) {
            return response()->json(['error' => 'Se requieren latitud y longitud'], 400);
        }

        try {
            $response = Http::get($this->apiUrl . '/weather', [
                'lat' => $lat,
                'lon' => $lon,
                'appid' => $this->appId,
            ]);

            return response()->json($response->json(), $response->status());
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener datos meteorológicos'], 500);
        }
    }

    // Método para obtener pronósticos meteorológicos
    public function getWeatherForecast(Request $request)
    {
        $lat = $request->query('lat');
        $lon = $request->query('lon');

        // Validar la entrada
        if (!$lat || !$lon) {
            return response()->json(['error' => 'Se requieren latitud y longitud'], 400);
        }

        try {
            $response = Http::get($this->apiUrl . '/weather/forecast', [
                'lat' => $lat,
                'lon' => $lon,
                'appid' => $this->appId,
            ]);

            return response()->json($response->json(), $response->status());
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener pronósticos meteorológicos'], 500);
        }
    }

    // Método para obtener datos actuales del suelo por polígono
    public function getSoilData(Request $request, $polygonId)
    {
        try {
            $response = Http::get($this->apiUrl . '/soil', [
                'polyid' => $polygonId,
                'appid' => $this->appId,
            ]);

            return response()->json($response->json(), $response->status());
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener datos del suelo'], 500);
        }
    }

    // Método para obtener el índice UV por polígono
    public function getUVIndex(Request $request)
    {
        $polyid = $request->query('polyid');

        // Validar la entrada
        if (!$polyid) {
            return response()->json(['error' => 'Se requiere el ID del polígono'], 400);
        }

        try {
            $response = Http::get($this->apiUrl . '/uvi', [
                'polyid' => $polyid,
                'appid' => $this->appId,
            ]);

            return response()->json($response->json(), $response->status());
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener el índice UV'], 500);
        }
    }


    public function getSatelliteImages($polygonId, Request $request)
    {
        try {
            // Verifica que el ID del polígono no esté vacío
            if (empty($polygonId)) {
                return response()->json(['error' => 'Se requiere el ID del polígono'], 400);
            }
    
            // Verifica que se proporcionen las fechas
            $startUnix = $request->input('start');
            $endUnix = $request->input('end');
    
            if (empty($startUnix) || empty($endUnix)) {
                return response()->json(['error' => 'Se requieren las fechas de inicio y fin'], 400);
            }
    
            // Hacer la solicitud a la API para obtener imágenes satelitales
            $response = Http::get($this->apiUrl . '/image/search', [
                'start' => $startUnix,
                'end' => $endUnix,
                'polyid' => $polygonId,
                'appid' => $this->appId,
            ]);
    
            // Verifica si la respuesta fue exitosa
            if ($response->successful()) {
                return response()->json($response->json(), 200);
            } else {
                // Manejo de errores basado en el código de estado de la respuesta
                return response()->json(['error' => 'Error en la API: ' . $response->body()], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener imágenes satelitales: ' . $e->getMessage()], 500);
        }
    }
    
    

}