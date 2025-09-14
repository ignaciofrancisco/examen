<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Mostrar la vista para solicitar enlace de restablecimiento.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Manejar la solicitud de enlace de restablecimiento.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        try {
            $status = Password::sendResetLink($request->only('email'));

            if ($status == Password::RESET_LINK_SENT) {
                return back()->with('status', 'Se ha enviado un enlace de recuperación a tu correo.');
            } else {
                return back()->with('error', 'Aún no está diseñado el envío de correos. Mas adelante lo configuraremos');
            }

        } catch (\Exception $e) {
            return back()->with('error', 'Error al intentar enviar el enlace: ' . $e->getMessage());
        }
    }
}
