<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Listar clientes
    public function index(Request $request)
    {
        try {
            $clients = Client::query()
                ->when($request->search, function ($q, $search) {
                    $q->where('rut_empresa', 'like', "%{$search}%")
                      ->orWhere('razon_social', 'like', "%{$search}%");
                })
                ->orderBy('id', 'desc')
                ->paginate(15);

            return view('clients.index', compact('clients'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error al cargar los clientes: ' . $e->getMessage());
        }
    }

    // Formulario crear cliente
    public function create()
    {
        return view('clients.create');
    }

    // Guardar cliente
    public function store(Request $request)
    {
        $request->validate([
            'rut_empresa' => 'required|string|max:20|unique:clients,rut_empresa',
            'rubro' => 'required|string|max:255',
            'razon_social' => 'required|string|max:255',
            'telefono' => 'required|string|max:50',
            'direccion' => 'required|string|max:255',
            'nombre_contacto' => 'required|string|max:255',
            'email_contacto' => 'required|email|max:255',
        ]);

        try {
            DB::beginTransaction();

            Client::create($request->all());

            DB::commit();

            return redirect()->route('clients.index')->with('success', 'Cliente creado correctamente.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Error al crear el cliente: ' . $e->getMessage());
        }
    }

    // Formulario editar cliente
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    // Actualizar cliente
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'rut_empresa' => 'required|string|max:20|unique:clients,rut_empresa,' . $client->id,
            'rubro' => 'required|string|max:255',
            'razon_social' => 'required|string|max:255',
            'telefono' => 'required|string|max:50',
            'direccion' => 'required|string|max:255',
            'nombre_contacto' => 'required|string|max:255',
            'email_contacto' => 'required|email|max:255',
        ]);

        try {
            DB::beginTransaction();

            $client->update($request->all());

            DB::commit();

            return redirect()->route('clients.index')->with('success', 'Cliente actualizado correctamente.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Error al actualizar el cliente: ' . $e->getMessage());
        }
    }

    // Eliminar cliente
    public function destroy(Client $client)
    {
        try {
            DB::beginTransaction();

            $client->delete();

            DB::commit();

            return redirect()->route('clients.index')->with('success', 'Cliente eliminado correctamente.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al eliminar el cliente: ' . $e->getMessage());
        }
    }
}
