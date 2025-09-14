@extends('layouts.app')

@section('title','Dashboard')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Dashboard</h4>

    <div class="row g-4">
        <!-- Usuarios -->
        <div class="col-md-4">
            <div class="card text-white bg-primary">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="card-title text-white">Usuarios</h5>
                        <p class="card-text display-5 text-white">{{ $usuarios }}</p>
                    </div>
                    <i class="ti ti-user ti-3x text-white"></i>
                </div>
            </div>
        </div>

        <!-- Productos -->
        <div class="col-md-4">
            <div class="card text-white bg-success">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="card-title text-white">Productos</h5>
                        <p class="card-text display-5 text-white">{{ $productos }}</p>
                    </div>
                    <i class="ti ti-box ti-3x text-white"></i>
                </div>
            </div>
        </div>

        <!-- Clientes -->
        <div class="col-md-4">
            <div class="card text-white bg-warning">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="card-title text-white">Clientes</h5>
                        <p class="card-text display-5 text-white">{{ $clientes }}</p>
                    </div>
                    <i class="ti ti-users ti-3x text-white"></i>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
