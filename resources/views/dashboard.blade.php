@extends('layouts.app')

@section('title','Dashboard')

@section('content')
<div class="row g-3">
  <div class="col-md-4">
    <div class="card text-center">
      <div class="card-body">
        <h5 class="card-title">Usuarios</h5>
        <p class="display-6 mb-0">{{ $users_count }}</p>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card text-center">
      <div class="card-body">
        <h5 class="card-title">Productos</h5>
        <p class="display-6 mb-0">{{ $products_count }}</p>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card text-center">
      <div class="card-body">
        <h5 class="card-title">Clientes</h5>
        <p class="display-6 mb-0">{{ $clients_count }}</p>
      </div>
    </div>
  </div>
</div>
@endsection
