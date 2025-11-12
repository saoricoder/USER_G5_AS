<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Maneja la autenticación del usuario y genera un token de acceso.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // 1. Validar las credenciales
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // 2. Intentar autenticar al usuario
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            // 3. Crear el token de acceso personal (usando Sanctum)
            // 'authToken' es el nombre del token
            $token = $user->createToken('authToken')->plainTextToken;

            // 4. Retornar la respuesta exitosa
            return response()->json([
                'message' => 'Login exitoso',
                'token' => $token, 
                'user' => $user
            ], 200);
        }

        // 5. Retornar error de credenciales
        return response()->json([
            'message' => 'Credenciales inválidas. Verifique su email y contraseña.'
        ], 401);
    }

    /**
     * Cierra la sesión del usuario actual y revoca el token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        // Revocar el token actual
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Sesión cerrada exitosamente'
        ], 200);
    }
}