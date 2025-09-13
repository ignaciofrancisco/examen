@extends('layouts.app')

@section('title','Usuarios')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h3">Usuarios</h1>
  <a href="{{ route('users.create') }}" class="btn btn-primary">Nuevo Usuario</a>
</div>

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>#</th>
      <th>RUT</th>
      <th>Nombre</th>
      <th>Apellido</th>
      <th>Email</th>
      <th>Rol</th>
      <th style="width:180px">Acciones</th>
    </tr>
  </thead>
  <tbody>
    @forelse($users as $user)
      <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->rut }}</td>
        <td>{{ $user->nombre }}</td>
        <td>{{ $user->apellido }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->role }}</td>
        <td>
          <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-secondary">Editar</a>

          <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar usuario?');">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-danger">Eliminar</button>
          </form>
        </td>
      </tr>
    @empty
      <tr><td colspan="7" class="text-center">No hay usuarios.</td></tr>
    @endforelse
  </tbody>
</table>

<div class="d-flex justify-content-center">
  {{ $users->links() }}
</div>
@endsection
