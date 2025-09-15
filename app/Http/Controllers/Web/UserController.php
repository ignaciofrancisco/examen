<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Exception;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Listar usuarios con búsqueda opcional por RUT
    public function index(Request $request)
    {
        try {
            $query = User::query();

            // Filtro por RUT si viene en el request
            if ($request->has('search') && $request->search != '') {
                $query->where('rut', 'like', '%' . $request->search . '%');
            }

            $users = $query->orderBy('id', 'desc')->paginate(15)->withQueryString();

            return view('users.index', compact('users'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error al cargar los usuarios: ' . $e->getMessage());
        }
    }

    // Formulario de creación
    public function create()
    {
        return view('users.create');
    }

    // Guardar usuario
    public function store(Request $request)
    {
        $request->validate([
            'rut' => 'required|unique:users,rut',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'role' => 'required|in:admin,user',
            'password' => 'required|string|min:6|confirmed',
        ]);

        try {
            DB::beginTransaction();

            $email = strtolower($request->nombre) . '.' . strtolower($request->apellido) . '@ventasfix.cl';

            User::create([
                'rut' => $request->rut,
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'email' => $email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            DB::commit();

            return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Error al crear el usuario: ' . $e->getMessage());
        }
    }

    // Mostrar usuario (redirige a edit para no duplicar vista)
    public function show(User $user)
    {
        return redirect()->route('users.edit', $user);
    }

    // Formulario de edición
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // Actualizar usuario
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            DB::beginTransaction();

            $data = $request->validated();

            if (!empty($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            } else {
                unset($data['password']);
            }

            $user->update($data);

            DB::commit();

            return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Error al actualizar el usuario: ' . $e->getMessage());
        }
    }

    // Eliminar usuario
    public function destroy(User $user)
    {
        try {
            DB::beginTransaction();

            $user->delete();

            DB::commit();

            return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al eliminar el usuario: ' . $e->getMessage());
        }
    }
}
