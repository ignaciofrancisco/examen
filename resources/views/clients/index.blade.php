@extends('layouts.app')

@section('title','Clientes')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h3">Clientes</h1>
  <a href="{{ route('clients.create') }}" class="btn btn-primary">Nuevo Cliente</a>
</div>

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>#</th>
      <th>RUT Empresa</th>
      <th>Razón Social</th>
      <th>Rubro</th>
      <th>Contacto</th>
      <th>Email Contacto</th>
      <th>Teléfono</th>
      <th>Dirección</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    @forelse($clients as $client)
    <tr>
      <td>{{ $client->id }}</td>
      <td>{{ $client->rut_empresa }}</td>
      <td>{{ $client->razon_social }}</td>
      <td>{{ $client->rubro }}</td>
      <td>{{ $client->contacto_nombre }}</td>
      <td>{{ $client->contacto_email }}</td>
      <td>{{ $client->telefono }}</td>
      <td>{{ $client->direccion }}</td>
      <td>
        <a href="{{ route('clients.edit', $client) }}" class="btn btn-sm btn-secondary">Editar</a>
        <form action="{{ route('clients.destroy', $client) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar cliente?');">
          @csrf
          @method('DELETE')
          <button class="btn btn-sm btn-danger">Eliminar</button>
        </form>
      </td>
    </tr>
    @empty
      <tr><td colspan="9" class="text-center">No hay clientes.</td></tr>
    @endforelse
  </tbody>
</table>

<div class="d-flex justify-content-center">
  {{ $clients->links() }}
</div>
@endsection
