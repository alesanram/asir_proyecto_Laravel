@extends('layout.layout')

@section('title', 'Catálogo de Productos')

@section('content')
    <h1>Catálogo de Productos</h1>

    @if (session('message'))
        <div id="message" class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form method="GET" action="{{ route('productos') }}" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <select name="filter_field" class="form-select">
                    <option value="name" {{ request()->get('filter_field') == 'name' ? 'selected' : '' }}>Nombre</option>
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
                <a href="{{ route('productos') }}" class="btn btn-secondary w-50">Cancelar</a>
            </div>
        </div>
    </form>

    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
        @foreach ($products as $product)
        <div class="col">
            <div class="card h-100 d-flex flex-column">
                <img src="{{ $product->image ? Storage::url($product->image) : 'https://via.placeholder.com/200x150?text=Imagen+no+disponible' }}" class="card-img-top" alt="Imagen del producto" style="max-height: 200px; object-fit: cover;">
                <div class="card-body d-flex flex-column flex-grow-1">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                    <p class="card-text"><strong>Precio: </strong>{{ number_format($product->price, 2)}}€</p>
                    <p class="card-text"><strong>Categoría: </strong>{{ $product->category?->name }}</p>
                    <p class="card-text"><strong>Unidades </strong>{{ $product->stock }}</p>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('cart.add', $product->id) }}" class="btn btn-primary">Añadir al carrito</a>
                </div>
            </div>
        </div>

        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $products->links() }}
    </div>
@endsection
