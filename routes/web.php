<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\UserController as WebUserController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\ProductController as WebProductController;
use App\Http\Controllers\Web\ClientController as WebClientController;




Route::get('/', function () {
    return redirect()->route('dashboard');
});


if (file_exists(__DIR__.'/auth.php')) {
    require __DIR__.'/auth.php';
}

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('users', WebUserController::class);
    Route::resource('products', WebProductController::class);
    Route::resource('clients', WebClientController::class);

    // productos y clientes los añadiremos luego
});
