@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalhes da compra {{ $compra->id }}</h2>

    <p><strong>Forma de Pagamento:</strong> {{ $compra->formaPgto }}</p>
    <p><strong>Data da Compra:</strong> {{ $compra->dataCompra }}</p>
    @if ($compra->dataRecebto)
        <p><strong>Data de Recebimento:</strong> {{ $compra->dataRecebto }}</p>
    @else
        <p><strong>Data de Recebimento:</strong> Não Recebido </p>
    @endif
    @if ($compra->obs)
        <p><strong>Observações:</strong> {{ $compra->obs }}</p>
    @else
        <p><strong>Observações:</strong> Nenhuma observação</p>
    @endif  

    @if ($compra->foto)
        <p><strong>Foto:</strong></p>
        <img src="{{ asset('storage/' . $compra->foto) }}" width="200">
        <br>
    @endif

    <a href="{{ route('compras.index') }}" class="btn btn-secondary mt-3">Voltar</a>
</div>
@endsection
