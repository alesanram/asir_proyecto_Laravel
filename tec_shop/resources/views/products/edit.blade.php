@extends('layout.layout')

@section('title', 'Editar Producto')

@section('content')
    <h1>Editar Producto</h1>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="description" class="form-label">Descripción</label>
                <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="col-md-6 mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="price" class="form-label">Precio</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" required>
            </div>

            <div class="col-md-12 mb-6">
                <label for="image" class="form-label">Imagen</label>
                @if($product->image)
                    <div>
                        <img src="{{ Storage::url($product->image) }}" alt="Imagen del producto" style="max-width: 150px;">
                        <p>Imagen actual</p>
                    </div>
                @endif
                <input type="file" name="image" accept="image/*">
            </div>

            <div class="col-md-6 mb-3">
                <label for="category" class="form-label">Categoría</label>
                <select name="category_id" id="category" class="form-select" required>
                    <option value="">Selecciona una categoría</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-warning">Actualizar Producto</button>
    </form>
@endsection
