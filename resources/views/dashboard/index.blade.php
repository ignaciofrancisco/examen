@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row mb-4">
    <!-- Bienvenido Card -->
    <div class="col-12">
        <div class="card">
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

<div class="row">
    <!-- Usuarios Card -->
    <div class="col-lg-4 col-md-6 col-12 mb-4">
        <div class="card">
            <div class="card-body d-flex align-items-center">
                <div class="avatar bg-label-primary me-3">
                    <i class="ti ti-users ti-lg"></i>
                </div>
                <div>
                    <h6 class="mb-0">Usuarios</h6>
                    <h4 class="fw-bold mb-0">{{ $usuarios_count ?? 0 }}</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Clientes Card -->
    <div class="col-lg-4 col-md-6 col-12 mb-4">
        <div class="card">
            <div class="card-body d-flex align-items-center">
                <div class="avatar bg-label-success me-3">
                    <i class="ti ti-user-check ti-lg"></i>
                </div>
                <div>
                    <h6 class="mb-0">Clientes</h6>
                    <h4 class="fw-bold mb-0">{{ $clientes_count ?? 0 }}</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Productos Card -->
    <div class="col-lg-4 col-md-6 col-12 mb-4">
        <div class="card">
            <div class="card-body d-flex align-items-center">
                <div class="avatar bg-label-warning me-3">
                    <i class="ti ti-package ti-lg"></i>
                </div>
                <div>
                    <h6 class="mb-0">Productos</h6>
                    <h4 class="fw-bold mb-0">{{ $productos_count ?? 0 }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
