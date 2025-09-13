@extends('layouts.app')

@section('title','Crear Producto')

@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Crear Producto</h5>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" novalidate>
      @csrf

      <div class="mb-3">
        <label class="form-label">SKU</label>
        <input type="text" name="sku" class="form-control" value="{{ old('sku') }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Descripción Corta</label>
        <input type="text" name="descripcion_corta" class="form-control" value="{{ old('descripcion_corta') }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Descripción Larga</label>
        <textarea name="descripcion_larga" class="form-control" rows="3" required>{{ old('descripcion_larga') }}</textarea>
      </div>

      <div class="mb-3">
        <label class="form-label">Precio Neto</label>
        <input type="number" name="precio_neto" class="form-control" value="{{ old('precio_neto') }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Stock Actual</label>
        <input type="number" name="stock_actual" class="form-control" value="{{ old('stock_actual') }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Imagen</label>
        <input type="file" name="imagen" class="form-control" required>
      </div>

      <button class="btn btn-primary">Crear</button>
      <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Cancelar</a>
    </form>
  </div>
</div>
@endsection
