@extends('layouts.app')

@section('title','Usuarios')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 fw-bold">Listado de Usuarios</h1>
    <a href="{{ route('users.create') }}" class="btn btn-success shadow-sm">
        + Nuevo Usuario
    </a>
</div>

{{-- Formulario de búsqueda por RUT --}}
<form action="{{ route('users.index') }}" method="GET" class="mb-3">
    <div class="input-group" style="max-width: 400px;">
        <input type="text" name="search" class="form-control" placeholder="Buscar por RUT..." value="{{ request('search') }}">
        <button class="btn btn-primary" type="submit">Buscar</button>
        @if(request('search'))
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Limpiar</a>
        @endif
    </div>
</form>

<div class="table-responsive shadow-sm">
    <table class="table table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th class="d-none">ID</th> {{-- Oculto --}}
                <th>RUT</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Rol</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td class="d-none">{{ $user->id }}</td> {{-- Oculto --}}
                    <td>{{ $user->rut }}</td>
                    <td class="fw-bold">{{ $user->nombre }}</td>
                    <td>{{ $user->apellido }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @php
                            $rol_color = match($user->role) {
                                'admin' => 'primary',
                                'user' => 'info',
                                'raton' => 'warning',
                                default => 'secondary',
                            };
                        @endphp
                        <span class="badge bg-{{ $rol_color }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-outline-primary me-1" title="Editar">
                            Editar
                        </a>
                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar usuario?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" title="Eliminar">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">No hay usuarios registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $users->links() }}
</div>

<style>
.table-hover tbody tr:hover {
    background-color: rgba(0,0,0,0.03);
}
.badge {
    font-size: 0.85rem;
    text-transform: capitalize;
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
