<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $clients = Client::orderBy('id', 'desc')->paginate(15);
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'rut_empresa' => 'required|unique:clients,rut_empresa',
            'rubro' => 'required|string|max:255',
            'razon_social' => 'required|string|max:255',
            'telefono' => 'required|string|max:50',
            'direccion' => 'required|string|max:255',
            'contacto_nombre' => 'required|string|max:255',
            'contacto_email' => 'required|email|max:255',
        ]);

        Client::create($request->all());

        return redirect()->route('clients.index')->with('success','Cliente creado correctamente.');
    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'rut_empresa' => 'required|unique:clients,rut_empresa,'.$client->id,
            'rubro' => 'required|string|max:255',
            'razon_social' => 'required|string|max:255',
            'telefono' => 'required|string|max:50',
            'direccion' => 'required|string|max:255',
            'contacto_nombre' => 'required|string|max:255',
            'contacto_email' => 'required|email|max:255',
        ]);

        $client->update($request->all());

        return redirect()->route('clients.index')->with('success','Cliente actualizado correctamente.');
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('clients.index')->with('success','Cliente eliminado correctamente.');
    }
}
