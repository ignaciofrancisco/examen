@extends('layouts.app')

@section('title','Clientes')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 fw-bold">Listado de Clientes</h1>
    <a href="{{ route('clients.create') }}" class="btn btn-success shadow-sm">
        + Nuevo Cliente
    </a>
</div>

{{-- Buscador --}}
<form action="{{ route('clients.index') }}" method="GET" class="mb-3 d-flex">
    <input type="text" name="search" value="{{ request('search') }}" class="form-control me-2" placeholder="Buscar por RUT o Razón Social">
    <button type="submit" class="btn btn-primary me-2">Buscar</button>
    <a href="{{ route('clients.index') }}" class="btn btn-outline-secondary">Limpiar</a>
</form>

<div class="table-responsive shadow-sm">
    <table class="table table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th class="d-none">ID</th> {{-- Oculto --}}
                <th>RUT Empresa</th>
                <th>Rubro</th>
                <th>Razón Social</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Nombre Contacto</th>
                <th>Email Contacto</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($clients as $client)
                <tr>
                    <td class="d-none">{{ $client->id }}</td>
                    <td>{{ $client->rut_empresa }}</td>
                    <td>{{ $client->rubro }}</td>
                    <td class="fw-bold">{{ $client->razon_social }}</td>
                    <td>{{ $client->telefono }}</td>
                    <td>{{ $client->direccion }}</td>
                    <td>{{ $client->nombre_contacto }}</td>
                    <td>{{ $client->email_contacto }}</td>
                    <td class="text-center">
                        <a href="{{ route('clients.edit', $client) }}" class="btn btn-sm btn-outline-primary me-1" title="Editar">
                            Editar
                        </a>
                        <form action="{{ route('clients.destroy', $client) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar cliente?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" title="Eliminar">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center text-muted">No hay clientes disponibles.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $clients->appends(['search' => request('search')])->links() }}
</div>

<style>
.table-hover tbody tr:hover {
    background-color: rgba(0,0,0,0.03);
}
.btn-outline-primary, .btn-outline-danger {
    transition: transform 0.2s;
}
.btn-outline-primary:hover, .btn-outline-danger:hover {
    transform: translateY(-2px);
}
.d-none {
    display: none !important; /* Oculta el ID */
}
</style>
@endsection
