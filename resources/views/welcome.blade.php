<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menu Inicial</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">

    <div class="text-center">
        <h1 class="mb-4">Sistema de Produtos</h1>
        <p class="mb-4">Escolha para onde deseja ir:</p>

        <div class="d-grid gap-3 col-6 mx-auto">
            <!-- Rota original "products" do tutorial -->
            <a href="{{ url('/products') }}" class="btn btn-primary btn-lg">
                Ir para Products
            </a>

            <!-- Nova rota "produtos" -->
            <a href="{{ route('produtos.index') }}" class="btn btn-success btn-lg">
                Ir para Produtos
            </a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
