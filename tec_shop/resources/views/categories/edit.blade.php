@extends('layout.layout')

@section('title', 'Editar Categoria')

@section('content')
    <h1>Editar Categoria</h1>

    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}" required>
            </div>
        </div>

        <button type="submit" class="btn btn-warning">Actualizar Categoria</button>
    </form>
@endsection
