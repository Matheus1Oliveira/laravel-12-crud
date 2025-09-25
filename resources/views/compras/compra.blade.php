@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Registrar Compra {{ $compra->id }}</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ops!</strong> Verifique os erros abaixo:<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('compras.compra.processar', $compra->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="formaPgto">Forma de Pagamento</label>
            <input type="text" name="formaPgto" class="form-control"
                   value="{{ old('formaPgto', $compra->formaPgto) }}" required>
        </div>

        <div class="mb-3">
            <label for="dataCompra">Data da Compra</label>
            <input type="date" name="dataCompra" class="form-control"
                   value="{{ old('dataCompra', optional($compra->dataCompra)->format('Y-m-d')) }}" required>
        </div>

        <div class="mb-3">
            <label for="dataRecebto">Data de Recebimento</label>
            <input type="date" name="dataRecebto" class="form-control"
                   value="{{ old('dataRecebto', optional($compra->dataRecebto)->format('Y-m-d')) }}">
        </div>

        <div class="mb-3">
            <label for="obs">Observações</label>
            <textarea name="obs" class="form-control">{{ old('obs', $compra->obs) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="foto">Foto</label>
            <input type="file" name="foto" class="form-control">
            @if ($compra->foto)
                <p>Foto atual:</p>
                <img src="{{ asset('storage/' . $compra->foto) }}" width="150">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Registrar Compra</button>
        <a href="{{ route('compras.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>
@endsection
