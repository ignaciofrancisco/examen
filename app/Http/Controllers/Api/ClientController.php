<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use Exception;

class ClientController extends Controller
{
    // Listar clientes con paginación
    public function index()
    {
        try {
            $clients = Client::paginate(15);
            return response()->json(['success' => true, 'data' => $clients], 200);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error al listar clientes', 'error' => $e->getMessage()], 500);
        }
    }

    // Crear cliente
    public function store(StoreClientRequest $request)
    {
        try {
            $data = $request->validated();
            $client = Client::create($data);
            return response()->json(['success' => true, 'message' => 'Cliente creado', 'data' => $client], 201);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error al crear cliente', 'error' => $e->getMessage()], 500);
        }
    }

    // Mostrar cliente
    public function show(Client $client)
    {
        try {
            return response()->json(['success' => true, 'data' => $client], 200);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error al obtener cliente', 'error' => $e->getMessage()], 500);
        }
    }

    // Actualizar cliente
    public function update(UpdateClientRequest $request, Client $client)
    {
        try {
            $data = $request->validated();
            $client->update($data);
            return response()->json(['success' => true, 'message' => 'Cliente actualizado', 'data' => $client], 200);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error al actualizar cliente', 'error' => $e->getMessage()], 500);
        }
    }

    // Eliminar cliente
    public function destroy(Client $client)
    {
        try {
            $client->delete();
            return response()->json(['success' => true, 'message' => 'Cliente eliminado'], 200);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error al eliminar cliente', 'error' => $e->getMessage()], 500);
        }
    }
}
