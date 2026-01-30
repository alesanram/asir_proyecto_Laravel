@extends('layout.layout')

@section('title', 'Inicio')

@section('content')
@if(auth()->check())
    <div class="container mt-5">
        <h1>Bienvenid@ Administrador</h1>
        <p>Seleccione una opción en el menú para gestionar productos.</p>
    </div>
@else
    <div class="container mt-5">
        <h1>Últimos Productos</h5>
    </div>
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
@endif
@endsection
