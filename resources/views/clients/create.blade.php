@extends('layouts.app')

@section('title','Crear Cliente')

@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Crear Cliente</h5>

    <form action="{{ route('clients.store') }}" method="POST" novalidate>
      @csrf

      <div class="mb-3">
        <label class="form-label">RUT Empresa</label>
        <input type="text" name="rut_empresa" class="form-control" value="{{ old('rut_empresa') }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Rubro</label>
        <input type="text" name="rubro" class="form-control" value="{{ old('rubro') }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Razón Social</label>
        <input type="text" name="razon_social" class="form-control" value="{{ old('razon_social') }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Teléfono</label>
        <input type="text" name="telefono" class="form-control" value="{{ old('telefono') }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Dirección</label>
        <input type="text" name="direccion" class="form-control" value="{{ old('direccion') }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Nombre de Contacto</label>
        <input type="text" name="nombre_contacto" class="form-control" value="{{ old('nombre_contacto') }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Email de Contacto</label>
        <input type="email" name="email_contacto" class="form-control" value="{{ old('email_contacto') }}" required>
      </div>

      <button class="btn btn-primary">Guardar Cliente</button>
      <a href="{{ route('clients.index') }}" class="btn btn-outline-secondary">Cancelar</a>
    </form>
  </div>
</div>
@endsection
