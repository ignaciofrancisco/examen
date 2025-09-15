<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;
use Exception;

class UserController extends Controller
{
    // Listar usuarios
    public function index()
    {
        try {
            $users = User::paginate(15);
            return response()->json(['success' => true, 'data' => $users], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al listar usuarios',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Crear usuario
    public function store(StoreUserRequest $request)
    {
        try {
            $data = $request->validated();
            $data['password'] = Hash::make($data['password']);
            $user = User::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Usuario creado',
                'data' => $user
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear usuario',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Mostrar usuario
    public function show(User $user)
    {
        try {
            return response()->json(['success' => true, 'data' => $user], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener usuario',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Actualizar usuario
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $data = $request->validated();
            if (!empty($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            } else {
                unset($data['password']);
            }

            $user->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Usuario actualizado',
                'data' => $user
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar usuario',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Eliminar usuario
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return response()->json([
                'success' => true,
                'message' => 'Usuario eliminado'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar usuario',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
