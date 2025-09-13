@extends('layouts.app')

@section('title','Productos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h3">Productos</h1>
  <a href="{{ route('products.create') }}" class="btn btn-primary">Nuevo Producto</a>
</div>

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>#</th>
      <th>SKU</th>
      <th>Nombre</th>
      <th>Precio Neto</th>
      <th>Precio Venta</th>
      <th>Stock</th>
      <th>Imagen</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    @forelse($products as $product)
    <tr>
      <td>{{ $product->id }}</td>
      <td>{{ $product->sku }}</td>
      <td>{{ $product->nombre }}</td>
      <td>{{ number_format($product->precio_neto,0,',','.') }}</td>
      <td>{{ number_format($product->precio_venta,0,',','.') }}</td>
      <td>{{ $product->stock_actual }}</td>
      <td>
        @if($product->imagen)
          <img src="{{ asset('storage/'.$product->imagen) }}" alt="" width="50">
        @endif
      </td>
      <td>
        <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-secondary">Editar</a>

        <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar producto?');">
          @csrf
          @method('DELETE')
          <button class="btn btn-sm btn-danger">Eliminar</button>
        </form>
      </td>
    </tr>
    @empty
      <tr><td colspan="8" class="text-center">No hay productos.</td></tr>
    @endforelse
  </tbody>
</table>

<div class="d-flex justify-content-center">
  {{ $products->links() }}
</div>
@endsection
