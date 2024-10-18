<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;

class UserController extends Controller
{
    // Mostrar todos los usuarios
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    // Mostrar un usuario específico
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    // Crear un nuevo usuario
    public function store(StoreUserRequest $request)
    {
        try {
            // Crear el nuevo usuario
            $user = User::create([
                'name' => $request->name,
                'last_name' => $request->last_name, // Apellido del usuario
                'email' => $request->email,
                'password' => bcrypt($request->password), // Hashear la contraseña
                'address' => $request->address, // Dirección
                'city' => $request->city, // Ciudad
                'country' => $request->country, // País
            ]);

            return response()->json($user, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al crear el usuario.'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        // Buscar al usuario por su ID
        $user = User::find($id);
    
        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
    
        // Validar los campos (son opcionales, pero si se envían, deben cumplir con las reglas)
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'last_name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|max:255',
            'address' => 'sometimes|string|max:255',
            'city' => 'sometimes|string|max:255',
            'country' => 'sometimes|string|max:255',
        ]);
    
        // Rellenar solo los campos que fueron enviados en la solicitud
        $user->fill($validated);
    
        // Guardar los cambios
        $user->save();
    
        // Devolver una respuesta de éxito con el usuario actualizado
        return response()->json(['message' => 'Usuario actualizado con éxito', 'user' => $user], 200);
    }
    

    // Eliminar un usuario
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(null, 204);
    }

    // Método para iniciar sesión
    public function login(Request $request)
    {
        // Validación de los datos de entrada
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Intentar autenticar al usuario
        if (auth()->attempt($request->only('email', 'password'))) {
            // Si la autenticación es exitosa, obtener el usuario
            $user = auth()->user();
            return response()->json(['user' => $user], 200);
        }

        // Si la autenticación falla
        return response()->json(['message' => 'Credenciales no válidas'], 401);
    }

    // Método para asignar un rol a un usuario
    public function assignRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|string|exists:roles,name', // Asegúrate de que el rol existe
        ]);

        $user = User::findOrFail($id);
        $user->assignRole($request->role); // Asignar el rol

        return response()->json(['message' => 'Rol asignado correctamente.']);
    }

    // Método para mostrar los roles de un usuario
    public function showRoles($id)
    {
        $user = User::findOrFail($id);
        $roles = $user->roles; // Obtener los roles del usuario

        return response()->json([
            'user_id' => $user->id,
            'roles' => $roles,
        ]);
    }
}
