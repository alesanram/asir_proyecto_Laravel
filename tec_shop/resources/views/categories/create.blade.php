@extends('layout.layout')

@section('title', 'Crear Categoria')

@section('content')
    <h1>Crear Categoria</h1>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        
        <div class="row">
            <div class="col-md-12 mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="col-md-6 d-flex gap-2">
                <button type="submit" class="btn btn-success w-50">Crear Categoria</button>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary w-50">Volver a la lista</a>
            </div>
        </div>
    </form>
@endsection
