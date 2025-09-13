@extends('layouts.app')

@section('title','Editar Cliente')

@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Editar Cliente</h5>

    <form action="{{ route('clients.update', $client) }}" method="POST" novalidate>
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label class="form-label">RUT Empresa</label>
        <input type="text" name="rut_empresa" class="form-control" value="{{ old('rut_empresa', $client->rut_empresa) }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Razón Social</label>
        <input type="text" name="razon_social" class="form-control" value="{{ old('razon_social', $client->razon_social) }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Rubro</label>
        <input type="text" name="rubro" class="form-control" value="{{ old('rubro', $client->rubro) }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Nombre Contacto</label>
        <input type="text" name="contacto_nombre" class="form-control" value="{{ old('contacto_nombre', $client->contacto_nombre) }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Email Contacto</label>
        <input type="email" name="contacto_email" class="form-control" value="{{ old('contacto_email', $client->contacto_email) }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Teléfono</label>
        <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $client->telefono) }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Dirección</label>
        <input type="text" name="direccion" class="form-control" value="{{ old('direccion', $client->direccion) }}" required>
      </div>

      <button class="btn btn-primary">Guardar</button>
      <a href="{{ route('clients.index') }}" class="btn btn-outline-secondary">Cancelar</a>
    </form>
  </div>
</div>
@endsection
