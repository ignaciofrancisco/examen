<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Exception;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try {
            $totalUsers = User::count();
            $totalClients = Client::count();
            $totalProducts = Product::count();

            $user = Auth::user();

            return view('dashboard.index', compact(
                'totalUsers',
                'totalClients',
                'totalProducts',
                'user'
            ));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error al cargar el dashboard: ' . $e->getMessage());
        }
    }
}
