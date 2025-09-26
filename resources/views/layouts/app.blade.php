<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD</title>

    <!-- Bootstrap 5 via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* altura mínima ocupa a tela inteira */
        }
        main {
            flex: 1; /* faz o conteúdo ocupar o espaço antes do footer */
        }
    </style>
</head>
<body>
    <!-- Navbar -->
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Menu</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Alternar navegação">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- Dropdown Products -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="productsDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Products
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="productsDropdown">
                        <li><a class="dropdown-item" href="{{ url('/products') }}">Ver Products</a></li>
                        <li><a class="dropdown-item" href="{{ url('/products/create') }}">Adicionar Product</a></li>
                    </ul>
                </li>

                <!-- Dropdown Compras -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="comprasDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Compras
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="comprasDropdown">
                        <li><a class="dropdown-item" href="{{ route('compras.index') }}">Ver Compras</a></li>
                        <li><a class="dropdown-item" href="{{ route('compras.create') }}">Registrar Compra</a></li>
                    </ul>
                </li>

                <!-- Autenticação -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('login') ? 'active' : '' }}" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('register') ? 'active' : '' }}" href="{{ route('register') }}">Register</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->isAdmin() ? 'true' : 'false' }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>


    <!-- Main content -->
    <main class="container py-4">
        @yield('content')
    </main>

    <!-- Footer sticky -->
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <div class="container">
            <small>
                &copy; <span id="year"></span> Rafael &amp; Gustavo Bernardini ®
            </small>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script para ano atual -->
    <script>
        document.getElementById("year").textContent = new Date().getFullYear();
    </script>
</body>
</html>
