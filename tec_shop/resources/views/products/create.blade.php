@extends('layout.layout')

@section('title', 'Crear Producto')

@section('content')
    <h1>Crear Producto</h1>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="category" class="form-label">Categoría</label>
                <select name="category_id" id="category" class="form-select" required>
                    <option value="">Selecciona una categoría</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-12 mb-6">
                <label for="description" class="form-label">Descripción</label>
                <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
            </div>

            <div class="col-md-6 mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock') }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="price" class="form-label">Precio</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}" required>
            </div>

            <div class="col-md-12 mb-6">
                <label for="image" class="form-label">Imagen</label>
                <input type="file" name="image" accept="image/*" required>
            </div>

            <div class="col-md-6 d-flex gap-2">
                <button type="submit" class="btn btn-success w-50">Guardar Producto</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary w-50">Volver a la lista</a>
            </div>
        </div>
    </form>

@endsection
