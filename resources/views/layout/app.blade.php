<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    
    <!-- Carga de estilos y scripts mediante Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light d-flex flex-column min-vh-100">

    <!-- Navbar simplificada -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-2 shadow-sm">
        <div class="container-fluid px-4">
            
            <!-- Marca/Logo -->
            <a class="navbar-brand text-white fw-semibold me-4" href="{{ url('/') }}">
                Inventario
            </a>
            
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Enlaces de navegación -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active fw-medium text-white' : 'text-secondary' }}" href="{{ url('/') }}">
                            Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('productos*') ? 'active fw-medium text-white' : 'text-secondary' }}" href="/products/show">
                            Productos
                        </a>
                    </li>
                </ul>
            </div>
            
        </div>
    </nav>

    <!-- Contenido Principal -->
    <main class="container-fluid px-4 px-lg-5 my-4 flex-fill">
        @yield('content')
    </main>

    <!-- Pie de página -->
    <footer class="bg-dark text-white text-center py-3 mt-auto border-top border-secondary">
        <div class="container-fluid">
            <p class="mb-0 small text-secondary">&copy; {{ date('Y') }} Allison</p>
        </div>
    </footer>
</body>
</html>
@yield('scripts')