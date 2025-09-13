@extends('layouts.app')

@section('title','Editar Usuario')

@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Editar Usuario</h5>

    <form action="{{ route('users.update', $user) }}" method="POST" novalidate>
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label class="form-label">RUT</label>
        <input type="text" name="rut" class="form-control" value="{{ old('rut', $user->rut) }}" required>
        @error('rut') <div class="text-danger small">{{ $message }}</div> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $user->nombre) }}" required>
        @error('nombre') <div class="text-danger small">{{ $message }}</div> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Apellido</label>
        <input type="text" name="apellido" class="form-control" value="{{ old('apellido', $user->apellido) }}" required>
        @error('apellido') <div class="text-danger small">{{ $message }}</div> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Password (dejar vacío para no cambiar)</label>
        <input type="password" name="password" class="form-control" placeholder="Nueva contraseña (opcional)">
        @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
      </div>

      <button class="btn btn-primary">Guardar</button>
      <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Cancelar</a>
    </form>
  </div>
</div>
@endsection
