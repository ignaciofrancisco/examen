@extends('layouts.app')

@section('title','Dashboard')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard</h1>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Usuarios</h5>
                    <p class="card-text display-5">{{ $usuarios }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Productos</h5>
                    <p class="card-text display-5">{{ $productos }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Clientes</h5>
                    <p class="card-text display-5">{{ $clientes }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
