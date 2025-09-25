@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalhes do Produto #{{ $produto->id }}</h2>

    <p><strong>Forma de Pagamento:</strong> {{ $produto->formaPgto }}</p>
    <p><strong>Data da Compra:</strong> {{ $produto->dataCompra }}</p>
    <p><strong>Data de Recebimento:</strong> {{ $produto->dataRecebto }}</p>
    <p><strong>Observações:</strong> {{ $produto->obs }}</p>

    @if ($produto->foto)
        <p><strong>Foto:</strong></p>
        <img src="{{ asset('storage/' . $produto->foto) }}" width="200">
    @endif

    <a href="{{ route('produtos.index') }}" class="btn btn-secondary mt-3">Voltar</a>
</div>
@endsection
