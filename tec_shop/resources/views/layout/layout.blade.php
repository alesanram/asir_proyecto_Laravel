<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>@yield('title', 'Tienda Informática')</title>
    <style>
        html, body {
            height: 100vh;
            margin: 0;
        }

        .full-height {
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        header, footer {
            background-color: #047876;
            flex-shrink: 0;
        }

        nav {
            max-width: 1200px;
            width: 100%;
            margin-left: auto;
            margin-right: auto;
        }

        .navbar-dark .navbar-nav .nav-link {
            color: #ffffff;
        }

        .navbar-dark .navbar-nav .nav-link:hover,
        .navbar-dark .navbar-nav .nav-link:focus {
            color: #f8f9fa;
        }

        .content {
            flex: 1 0 auto;
            max-width: 1200px;
            width: 100%;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>
    <div class="full-height">
        @include('layout.header')

        <div class="content px-3 py-3">
            @yield('content')
        </div>

        @include('layout.footer')
    </div>
    @if (session('message'))
        <script>
            setTimeout(function() {
                var message = document.getElementById('message');
                if (message) {
                    message.style.display = 'none';
                }
            }, 3000);
        </script>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
