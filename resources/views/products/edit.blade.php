@extends('layouts.app')

@section('title','Editar Producto')

@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Editar Producto</h5>

    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data" novalidate>
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label class="form-label">SKU</label>
        <input type="text" name="sku" class="form-control" value="{{ old('sku', $product->sku) }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $product->nombre) }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Descripción Corta</label>
        <input type="text" name="descripcion_corta" class="form-control" value="{{ old('descripcion_corta', $product->descripcion_corta) }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Descripción Larga</label>
        <textarea name="descripcion_larga" class="form-control" rows="3" required>{{ old('descripcion_larga', $product->descripcion_larga) }}</textarea>
      </div>

      <div class="mb-3">
        <label class="form-label">Precio Neto</label>
        <input type="number" name="precio_neto" class="form-control" value="{{ old('precio_neto', $product->precio_neto) }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Stock Actual</label>
        <input type="number" name="stock_actual" class="form-control" value="{{ old('stock_actual', $product->stock_actual) }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Imagen Actual</label><br>
        @if($product->imagen)
          <img src="{{ asset('storage/'.$product->imagen) }}" alt="" width="100">
        @endif
      </div>

      <div class="mb-3">
        <label class="form-label">Nueva Imagen (opcional)</label>
        <input type="file" name="imagen" class="form-control">
      </div>

      <button class="btn btn-primary">Guardar</button>
      <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Cancelar</a>
    </form>
  </div>
</div>
@endsection
