<header>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            @if(auth()->check())
                <a class="navbar-brand" href="{{ route('welcome.auth') }}">Tienda Informática</a>
            @else
                <a class="navbar-brand" href="{{ route('welcome') }}">Tienda Informática</a>
            @endif
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 text-light">
                    @if(auth()->check())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('products.create') }}">Crear Producto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('products.index') }}">Listado Productos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('categories.create') }}">Crear Categoria</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('categories.index') }}">Listado Categoria</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('productos') }}">Listado Productos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cart') }}">Mi Carrito</a>
                        </li>
                    @endif
                </ul>

                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-light">
                    @if(auth()->check())
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-link text-light">Cerrar sesión</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>

