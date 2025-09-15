@extends('layouts.app')

@section('title','Productos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 fw-bold">Listado de Productos</h1>
    <a href="{{ route('products.create') }}" class="btn btn-success shadow-sm">
        + Nuevo Producto
    </a>
</div>

<!-- Buscador -->
<form method="GET" action="{{ route('products.index') }}" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Buscar por SKU o nombre..." value="{{ request('search') }}">
        <button class="btn btn-primary" type="submit">Buscar</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Limpiar</a>
    </div>
</form>

<div class="table-responsive shadow-sm">
    <table class="table table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th class="d-none">ID</th> {{-- Oculto --}}
                <th>Imagen</th>
                <th>SKU</th>
                <th>Nombre</th>
                <th>Precio Neto</th>
                <th>Precio Venta</th>
                <th>Stock</th>
                <th>Creado</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr>
                    <td class="d-none">{{ $product->id }}</td> {{-- Oculto --}}
                    <td style="width: 120px;">
                        @if($product->imagen && file_exists(storage_path('app/public/'.$product->imagen)))
                            <a href="{{ asset('storage/'.$product->imagen) }}" target="_blank">
                                <div class="thumb-container">
                                    <img src="{{ asset('storage/'.$product->imagen) }}" alt="{{ $product->nombre }}">
                                </div>
                            </a>
                        @else
                            <div class="thumb-container bg-light d-flex align-items-center justify-content-center">
                                <span class="text-muted small">Sin imagen</span>
                            </div>
                        @endif
                    </td>
                    <td>{{ $product->sku }}</td>
                    <td class="fw-bold">{{ $product->nombre }}</td>
                    <td>${{ number_format($product->precio_neto,0,',','.') }}</td>
                    <td class="text-success fw-bold">${{ number_format($product->precio_venta,0,',','.') }}</td>
                    <td>
                        @if($product->stock_actual <= $product->stock_minimo)
                            <span class="badge bg-danger">Bajo ({{ $product->stock_actual }})</span>
                        @elseif($product->stock_actual >= $product->stock_alto)
                            <span class="badge bg-success">Alto ({{ $product->stock_actual }})</span>
                        @else
                            <span class="badge bg-warning text-dark">Normal ({{ $product->stock_actual }})</span>
                        @endif
                    </td>
                    <td>{{ $product->created_at->format('d/m/Y') }}</td>
                    <td class="text-center">
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-outline-primary me-1">Editar</a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar producto?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center text-muted">No hay productos disponibles.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $products->appends(['search' => request('search')])->links() }}
</div>

<style>
.thumb-container {
    width: 100px;
    height: 100px;
    overflow: hidden;
    border-radius: 8px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.15);
    display: flex;
    align-items: center;
    justify-content: center;
}
.thumb-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.2s ease-in-out;
}
.thumb-container img:hover {
    transform: scale(1.05);
}
.table-hover tbody tr:hover {
    background-color: rgba(0,0,0,0.03);
}
.d-none {
    display: none !important;
}
</style>
@endsection
