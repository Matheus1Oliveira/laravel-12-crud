@extends('layouts.app')

@section('content')

    <div class="text-center">
        <h1 class="mb-4 fw-bold">Sistema CRUD</h1>

        <div class="row g-4 justify-content-center">
            <div class="col-12 col-md-5">
                <div class="card card-hover border-0 shadow-sm">
                    <div class="card-body text-center">
                        <h3 class="card-title mb-3">Produtos</h3>
                        <p class="card-text text-muted mb-4">CRUD original de Produtos</p>
                        <a href="{{ url('/products') }}" class="btn btn-primary btn-lg btn-custom">Ir para Produtos</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-5">
                <div class="card card-hover border-0 shadow-sm">
                    <div class="card-body text-center">
                        <h3 class="card-title mb-3">Compras</h3>
                        <p class="card-text text-muted mb-4">CRUD de Compras</p>
                        <a href="{{ route('compras.index') }}" class="btn btn-success btn-lg btn-custom">Ir para Compras</a>
                    </div>
                </div>
            </div>
            @if(Auth::check() && Auth::user()->is_admin)
                <div class="col-12 col-md-5">
                    <div class="card card-hover border-0 shadow-sm">
                        <div class="card-body text-center">
                            <h3 class="card-title mb-3">Usuários</h3>
                            <p class="card-text text-muted mb-4">CRUD Usuários do Sistema</p>
                            <a href="{{ route('users.index') }}" class="btn btn-warning btn-lg btn-custom text-white">Ir para Usuários</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection
