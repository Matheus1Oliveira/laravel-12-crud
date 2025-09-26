@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Detalhes do Produto</h2>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Voltar
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="mb-3">
                <strong>Código:</strong>
                <p class="mb-0">{{ $product->code }}</p>
            </div>

            <div class="mb-3">
                <strong>Nome:</strong>
                <p class="mb-0">{{ $product->name }}</p>
            </div>

            <div class="mb-3">
                <strong>Quantidade:</strong>
                <p class="mb-0">{{ $product->quantity }}</p>
            </div>

            <div class="mb-3">
                <strong>Preço:</strong>
                <p class="mb-0">R$ {{ number_format($product->price, 2, ',', '.') }}</p>
            </div>

            <div class="mb-3">
                <strong>Descrição:</strong>
                <p class="mb-0">{{ $product->description }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
