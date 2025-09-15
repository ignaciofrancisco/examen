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
        <label class="form-label">Rol</label>
        <select name="role" class="form-select" required>
          <option value="">Selecciona un rol</option>
          <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
          <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Usuario</option>
        </select>
        @error('role') <div class="text-danger small">{{ $message }}</div> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Contraseña</label>
        <input type="password" name="password" class="form-control" required>
        @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Confirmar Contraseña</label>
        <input type="password" name="password_confirmation" class="form-control" required>
      </div>

      <button class="btn btn-primary">Crear Usuario</button>
      <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Cancelar</a>
    </form>
  </div>
</div>
@endsection
