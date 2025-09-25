@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Novo Compra</h2>

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

    <form action="{{ route('compras.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="formaPgto">Forma de Pagamento</label>
            <select name="formaPgto" class="form-control" required>
                <option value="" disabled {{ old('formaPgto') ? '' : 'selected' }}>Selecione...</option>
                <option value="Boleto" {{ old('formaPgto') == 'Boleto' ? 'selected' : '' }}>Boleto</option>
                <option value="Cartão de Crédito" {{ old('formaPgto') == 'Cartão de Crédito' ? 'selected' : '' }}>Cartão de Crédito</option>
                <option value="PIX" {{ old('formaPgto') == 'PIX' ? 'selected' : '' }}>PIX</option>
                <option value="Dinheiro" {{ old('formaPgto') == 'Dinheiro' ? 'selected' : '' }}>Dinheiro</option>
            </select>
        </div>


        <div class="mb-3">
            <label for="dataCompra">Data da Compra</label>
            <input type="date" name="dataCompra" class="form-control"
                value="{{now()->format('Y-m-d') }}" required>
        </div>



        <div class="mb-3">
            <label for="dataRecebto">Data de Recebimento</label>
            <input type="date" name="dataRecebto" class="form-control" value="{{ old('dataRecebto') }}">
        </div>

        <div class="mb-3">
            <label for="obs">Observações</label>
            <textarea name="obs" class="form-control">{{ old('obs') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="foto">Foto</label>
            <input type="file" name="foto" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('compras.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>
@endsection
