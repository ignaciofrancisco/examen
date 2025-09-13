<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;

class ClientController extends Controller
{
    public function index()
    {
        return response()->json(Client::paginate(15));
    }

    public function store(StoreClientRequest $request)
    {
        $data = $request->validated();
        $client = Client::create($data);
        return response()->json(['message' => 'Cliente creado', 'data' => $client], 201);
    }

    public function show(Client $client)
    {
        return response()->json($client);
    }

    public function update(UpdateClientRequest $request, Client $client)
    {
        $data = $request->validated();
        $client->update($data);
        return response()->json(['message' => 'Cliente actualizado', 'data' => $client]);
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return response()->json(['message' => 'Cliente eliminado']);
    }
}
