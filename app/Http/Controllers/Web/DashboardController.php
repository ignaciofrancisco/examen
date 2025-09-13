<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Client;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
    }

    public function index()
    {
        $usuarios = User::count();
        $productos = Product::count();
        $clientes = Client::count();

        return view('dashboard.index', compact('usuarios','productos','clientes'));
    }
}
