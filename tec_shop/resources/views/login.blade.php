@extends('layout.layout')

@section('title', 'Login')

@section('content')
    <div class="container">
        <h1 class="my-4">Iniciar sesión</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('authenticate') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico:</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Iniciar sesión</button>
        </form>
    </div>
@endsection
