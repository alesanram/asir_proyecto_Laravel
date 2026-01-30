@extends('layout.layout')

@section('title', 'Mi carrito')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Carrito de Compras</h1>

    @if(count($cart) > 0)
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Producto</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Total</th>
                        <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach ($cart as $productId => $item)
                        @php
                            $itemTotal = $item['quantity'] * $item['price'];
                            $total += $itemTotal;
                            $image = $item['image'] ? Storage::url($item['image']) : asset('images/default-product.png');
                        @endphp
                        <tr>
                            <td class="d-flex align-items-center">
                                <img src="{{ $image }}" alt="Producto" class="img-thumbnail me-3" style="width: 100px; height: 100px; object-fit: cover;">
                                <div>
                                    <strong>{{ $item['name'] }}</strong><br>
                                    <small class="text-muted">{{ $item['description'] ?? '' }}</small>
                                </div>
                            </td>
                            <td>
                                {{ $item['quantity'] }}
                            </td>
                            <td>{{ number_format($item['price'], 2) }}€</td>
                            <td>{{ number_format($itemTotal, 2) }}€</td>
                            <td>
                                <a href="{{ route('cart.remove', $productId) }}" class="btn btn-outline-danger btn-sm">Remover</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap">
            <h3>Total: {{ number_format($total, 2) }}€</h3>
            <div class="mt-2">
                <a href="{{ route('cart.clear') }}" class="btn btn-outline-danger btn-lg me-2" onclick="return confirm('¿Estás seguro de que quieres vaciar el carrito?')">Vaciar Carrito</a>
                <a href="{{ route('cart.finish') }}" class="btn btn-success btn-lg">Finalizar Compra</a>
            </div>
        </div>
    @else
        <div class="alert alert-warning mt-4" role="alert">
            No hay productos en tu carrito.
        </div>
    @endif
</div>
@endsection
