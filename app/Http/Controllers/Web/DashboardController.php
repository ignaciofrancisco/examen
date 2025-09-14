<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
use App\Models\Product;
use Illuminate\Support\Facades\Auth; // ✅ Importar Auth

class DashboardController extends Controller
{
    public function index()
    {
        $usuarios_count = User::count();
        $clientes_count = Client::count();
        $productos_count = Product::count();

        $user = Auth::user(); // 👈 Ahora Intelephense reconoce el método

        return view('dashboard.index', compact(
            'usuarios_count',
            'clientes_count',
            'productos_count',
            'user'
        ));
    }
}
