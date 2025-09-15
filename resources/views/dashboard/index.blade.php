@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row mb-4">
    <!-- Bienvenido Card -->
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="fw-bold mb-2">
                    Bienvenido, {{ auth()->user()->nombre ?? '' }} {{ auth()->user()->apellido ?? '' }}!
                </h4>
                <p class="mb-0">
                    Este es tu panel de control. Aquí puedes ver rápidamente la cantidad de usuarios, clientes y productos registrados.
                </p>
            </div>
        </div>
    </div>
</div>

@php
$cards = [
    ['title' => 'Usuarios', 'count' => $totalUsers ?? 0, 'icon' => 'ti-users', 'bg' => 'bg-primary', 'text' => 'text-white', 'route' => route('users.index')],
    ['title' => 'Clientes', 'count' => $totalClients ?? 0, 'icon' => 'ti-user-check', 'bg' => 'bg-success', 'text' => 'text-white', 'route' => route('clients.index')],
    ['title' => 'Productos', 'count' => $totalProducts ?? 0, 'icon' => 'ti-package', 'bg' => 'bg-warning', 'text' => 'text-dark', 'route' => route('products.index')],
];
@endphp

<div class="row g-4">
    @foreach($cards as $card)
    <div class="col-lg-4 col-md-6 col-12">
        <a href="{{ $card['route'] }}" class="text-decoration-none">
            <div class="card {{ $card['bg'] }} {{ $card['text'] }} shadow-sm border-0 hover-card">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div class="fs-2">
                        <i class="ti {{ $card['icon'] }}"></i>
                    </div>
                    <div class="text-end">
                        <h6 class="mb-1">{{ $card['title'] }}</h6>
                        <h3 class="fw-bold mb-0">{{ $card['count'] }}</h3>
                    </div>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>

<!-- Estilos -->
<style>
.hover-card {
    transition: transform 0.3s, box-shadow 0.3s;
    border-radius: 0.75rem;
}
.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.15);
}
.card .ti {
    font-size: 2.5rem;
}
</style>
@endsection
