@extends('layout.layout')

@section('title', 'Listado de Categorias')

@section('content')
        <h1>Listado de Categorias</h1>

        <form method="GET" action="{{ route('categories.index') }}" class="mb-3">
            <div class="row">
                <div class="col-md-4">
                    <p class="rounded-pill d-flex align-items-center px-3">
                        Nombre
                    </p>
                </div>
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" value="{{ request()->get('search') }}" placeholder="Buscar...">
                </div>
                <div class="col-md-4 d-flex gap-2">
                    <button type="submit" class="btn btn-success w-50">Buscar</button>
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary w-50">Cancelar</a>
                </div>
            </div>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary">Editar</a>
                    </td>
                    <td>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-4">
            {{ $products->links() }}
        </div>
@endsection
