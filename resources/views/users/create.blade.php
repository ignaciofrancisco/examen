@extends('layouts.app')

@section('title','Crear Usuario')

@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Crear Usuario</h5>

    <form action="{{ route('users.store') }}" method="POST" novalidate>
      @csrf

      <div class="mb-3">
        <label class="form-label">RUT</label>
        <input type="text" name="rut" class="form-control" value="{{ old('rut') }}" required>
        @error('rut') <div class="text-danger small">{{ $message }}</div> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
        @error('nombre') <div class="text-danger small">{{ $message }}</div> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Apellido</label>
        <input type="text" name="apellido" class="form-control" value="{{ old('apellido') }}" required>
        @error('apellido') <div class="text-danger small">{{ $message }}</div> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
        @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
      </div>

      <button class="btn btn-primary">Crear</button>
      <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Cancelar</a>
    </form>
  </div>
</div>
@endsection
