@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar compra {{ $compra->id }}</h2>

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

    <form action="{{ route('compras.update', $compra->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="formaPgto">Forma de Pagamento</label>
            <select name="formaPgto" class="form-control" required>
                <option value="" disabled {{ old('formaPgto', $compra->formaPgto) ? '' : 'selected' }}>Selecione...</option>
                <option value="Boleto" {{ old('formaPgto', $compra->formaPgto) == 'Boleto' ? 'selected' : '' }}>Boleto</option>
                <option value="Cartão de Crédito" {{ old('formaPgto', $compra->formaPgto) == 'Cartão de Crédito' ? 'selected' : '' }}>Cartão de Crédito</option>
                <option value="PIX" {{ old('formaPgto', $compra->formaPgto) == 'PIX' ? 'selected' : '' }}>PIX</option>
                <option value="Dinheiro" {{ old('formaPgto', $compra->formaPgto) == 'Dinheiro' ? 'selected' : '' }}>Dinheiro</option>
            </select>
        </div>


        <div class="mb-3">
            <label for="dataCompra">Data da Compra</label>
            <input type="date" name="dataCompra" class="form-control"
                value="{{ old('dataCompra', $compra->dataCompra ? \Carbon\Carbon::parse($compra->dataCompra)->format('Y-m-d') : '') }}" required>
        </div>

        <div class="mb-3">
            <label for="dataRecebto">Data de Recebimento</label>
            <input type="date" name="dataRecebto" class="form-control"
                value="{{ old('dataRecebto', $compra->dataRecebto ? \Carbon\Carbon::parse($compra->dataRecebto)->format('Y-m-d') : '') }}">
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

        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="{{ route('compras.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>
@endsection
