<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    private $geminiApiUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent'; // URL de la API
    private $apiKey;

    public function __construct()
    {
        // Cargar la clave de API desde el archivo .env
        $this->apiKey = env('GEMINI_API_KEY');
    }

    public function sendMessage(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'message' => 'required|string',
        ]);

        // Preparar el cuerpo de la solicitud
        $payload = [
            'contents' => [
                [
                    'parts' => [
                        [
                            'text' => $request->input('message'), // El contenido del mensaje
                        ],
                    ],
                ],
            ],
        ];

        // Hacer la solicitud a la API de Gemini
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post("{$this->geminiApiUrl}?key={$this->apiKey}", $payload);

        // Manejar la respuesta
        if ($response->successful()) {
            return response()->json([
                'success' => true,
                'data' => $response->json(),
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error en la comunicación con la API.',
                'error' => $response->body(),
            ], $response->status());
        }
    }
}
