@extends('layouts.app')

@section('title','Editar Producto')

@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Editar Producto</h5>

    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label class="form-label">SKU</label>
        <input type="text" name="sku" class="form-control" value="{{ old('sku', $product->sku) }}" required>
        @error('sku') <div class="text-danger small">{{ $message }}</div> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $product->nombre) }}" required>
        @error('nombre') <div class="text-danger small">{{ $message }}</div> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Descripción Corta</label>
        <input type="text" name="descripcion_corta" class="form-control" value="{{ old('descripcion_corta', $product->descripcion_corta) }}">
        @error('descripcion_corta') <div class="text-danger small">{{ $message }}</div> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Descripción Larga</label>
        <textarea name="descripcion_larga" class="form-control">{{ old('descripcion_larga', $product->descripcion_larga) }}</textarea>
        @error('descripcion_larga') <div class="text-danger small">{{ $message }}</div> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Precio Neto</label>
        <input type="number" step="0.01" name="precio_neto" class="form-control" value="{{ old('precio_neto', $product->precio_neto) }}" required>
        @error('precio_neto') <div class="text-danger small">{{ $message }}</div> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Stock Actual</label>
        <input type="number" name="stock_actual" class="form-control" value="{{ old('stock_actual', $product->stock_actual) }}" required>
        @error('stock_actual') <div class="text-danger small">{{ $message }}</div> @enderror
      </div>

      <div class="row">
        <div class="col-md-4 mb-3">
          <label class="form-label">Stock Mínimo</label>
          <input type="number" name="stock_minimo" class="form-control" value="{{ old('stock_minimo', $product->stock_minimo) }}">
        </div>
        <div class="col-md-4 mb-3">
          <label class="form-label">Stock Bajo</label>
          <input type="number" name="stock_bajo" class="form-control" value="{{ old('stock_bajo', $product->stock_bajo) }}">
        </div>
        <div class="col-md-4 mb-3">
          <label class="form-label">Stock Alto</label>
          <input type="number" name="stock_alto" class="form-control" value="{{ old('stock_alto', $product->stock_alto) }}">
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label">Imagen Actual</label><br>
        @if($product->imagen)
          <img src="{{ asset('storage/'.$product->imagen) }}" class="img-thumbnail mb-2" width="150" alt="Imagen actual">
        @endif
      </div>

      <div class="mb-3">
        <label class="form-label">Nueva Imagen (opcional)</label>
        <input type="file" name="imagen" class="form-control">
        @error('imagen') <div class="text-danger small">{{ $message }}</div> @enderror
      </div>

      <button class="btn btn-primary">Actualizar Producto</button>
      <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Cancelar</a>
    </form>
  </div>
</div>
@endsection
