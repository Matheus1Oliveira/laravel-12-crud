<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
            flex: 1;
        }
        /* Dropdown escuro */
        .navbar-dark .dropdown-menu {
            background-color: #343a40;
        }
        .navbar-dark .dropdown-menu .dropdown-item {
            color: #fff;
        }
        .navbar-dark .dropdown-menu .dropdown-item:hover {
            background-color: #495057;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <i class="bi bi-house-door-fill me-2"></i> Home
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                    aria-label="Alternar navegação">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="productsDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Products
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="productsDropdown">
                            <li><a class="dropdown-item" href="{{ url('/products') }}">Gerenciar Products</a></li>
                            @auth
                                <li><a class="dropdown-item" href="{{ url('/products/create') }}">Adicionar Product</a></li>
                            @endauth
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="comprasDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Compras
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="comprasDropdown">
                            <li><a class="dropdown-item" href="{{ route('compras.index') }}">Gerenciar Compras</a></li>
                            @auth
                                <li><a class="dropdown-item" href="{{ route('compras.create') }}">Registrar Compra</a></li>
                            @endauth
                        </ul>
                    </li>

                    @guest
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('login') ? 'active' : '' }}" href="{{ route('login') }}">Login</a>
                        </li>
                    @endguest

                    @auth
                        @if (Auth::user()->is_admin)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="usersDropdown" role="button"
                                   data-bs-toggle="dropdown" aria-expanded="false">
                                    Usuários
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="usersDropdown">
                                    <li><a class="dropdown-item" href="{{ route('users.index') }}">Gerenciar Usuários</a></li>
                                    <li><a class="dropdown-item" href="{{ route('register') }}">Adicionar Usuário</a></li>
                                </ul>
                            </li>
                        @endif

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                @if(Auth::user()->foto)
                                    <img src="{{ asset('storage/' . Auth::user()->foto) }}" 
                                         alt="Foto de {{ Auth::user()->name }}" 
                                         class="rounded-circle me-2"
                                         style="width:35px; height:35px; object-fit:cover;">
                                @else
                                    <img src="{{ asset('sem-img.png') }}" 
                                         alt="Sem foto" 
                                         class="rounded-circle me-2"
                                         style="width:35px; height:35px; object-fit:cover;">
                                @endif
                                <span class="d-md-inline">{{ Auth::user()->name }}</span>

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
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        @yield('content')
    </main>

    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <div class="container">
            <small>
                &copy; <span id="year"></span> Rafael &amp; Gustavo Bernardini
            </small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById("year").textContent = new Date().getFullYear();
    </script>
</body>
</html>
