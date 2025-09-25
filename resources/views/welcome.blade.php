@extends('layouts.app')

@section('content')

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="text-center">
        <h1 class="mb-4 fw-bold">Sistema CRUD</h1>

        <div class="row g-4 justify-content-center">
            <!-- Card Products -->
            <div class="col-12 col-md-5">
                <div class="card card-hover border-0 shadow-sm">
                    <div class="card-body text-center">
                        <h3 class="card-title mb-3">Products</h3>
                        <p class="card-text text-muted mb-4">Gerencie o CRUD original de Products</p>
                        <a href="{{ url('/products') }}" class="btn btn-primary btn-lg btn-custom">Ir para Products</a>
                    </div>
                </div>
            </div>

            <!-- Card Compras -->
            <div class="col-12 col-md-5">
                <div class="card card-hover border-0 shadow-sm">
                    <div class="card-body text-center">
                        <h3 class="card-title mb-3">Compras</h3>
                        <p class="card-text text-muted mb-4">Gerencie suas compras cadastradas</p>
                        <a href="{{ route('compras.index') }}" class="btn btn-success btn-lg btn-custom">Ir para Compras</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
