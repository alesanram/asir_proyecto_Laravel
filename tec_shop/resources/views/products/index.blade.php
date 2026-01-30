@extends('layout.layout')

@section('title', 'Listado de Productos')

@section('content')
        <h1>Listado de Productos</h1>

        <!-- Formulario de búsqueda -->
        <form method="GET" action="{{ route('products.index') }}" class="mb-3">
            <div class="row">
                <div class="col-md-4">
                    <select name="filter_field" class="form-select">
                        <option value="name" {{ request()->get('filter_field') == 'description' ? 'selected' : '' }}>Nombre</option>
                        <option value="description" {{ request()->get('filter_field') == 'description' ? 'selected' : '' }}>Descripción</option>
                        <option value="stock" {{ request()->get('filter_field') == 'stock' ? 'selected' : '' }}>Stock</option>
                        <option value="price" {{ request()->get('filter_field') == 'price' ? 'selected' : '' }}>Precio</option>
                        <option value="category" {{ request()->get('filter_field') == 'category' ? 'selected' : '' }}>Categoría</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" value="{{ request()->get('search') }}" placeholder="Buscar...">
                </div>
                <div class="col-md-4 d-flex gap-2">
                    <button type="submit" class="btn btn-success w-50">Buscar</button>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary w-50">Cancelar</a>
                </div>
            </div>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Stock</th>
                    <th>Precio</th>
                    <th>Categoría</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->price }}€</td>
                    <td>{{ $product->category?->name }}</td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary text-light">Editar</a>
                    </td>
                    <td>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $products->links() }}
        </div>
@endsection
