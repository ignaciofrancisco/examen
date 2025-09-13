<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Login de usuario y generación de token Sanctum
     */
    public function login(Request $request)
    {
        // Validación de datos
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        // Intento de login
        if (!Auth::attempt($request->only('email','password'))) {
            return response()->json(['message' => 'Credenciales inválidas'], 401);
        }

        // Usuario autenticado
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Generar token de acceso
        /** @var \Laravel\Sanctum\NewAccessToken $token */
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'message' => 'Login correcto',
            'token' => $token,
            'user' => $user
        ]);
    }

    /**
     * Logout de usuario y revocar token actual
     */
    public function logout(Request $request)
    {
        $user = $request->user();

        if ($user && $request->user()->currentAccessToken()) {
            $user->currentAccessToken()->delete();
        }

        return response()->json(['message' => 'Logout correcto']);
    }
}
