<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Database\QueryException;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'rut' => ['required', 'string', 'max:12'], // Validación básica del RUT
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Construir el email automáticamente
        $email = strtolower($request->nombre . '.' . $request->apellido . '@ventasfix.cl');

        try {
            $user = User::create([
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'rut' => $request->rut,
                'email' => $email,
                'password' => Hash::make($request->password),
            ]);

            event(new Registered($user));
            Auth::login($user);

            return redirect()->route('dashboard');

        } catch (QueryException $e) {
            // Verificar si es un error de duplicado (RUT único)
            if ($e->getCode() == 23000) { // Código SQL de violación de llave única
                return back()->withInput()
                             ->with('error', 'El RUT ya está siendo utilizado.');
            }

            // Otro tipo de error
            return back()->withInput()
                         ->with('error', 'Ocurrió un error al registrar el usuario.');
        }
    }
}
