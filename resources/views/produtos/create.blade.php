@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Novo Produto</h2>

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

    <form action="{{ route('produtos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="formaPgto">Forma de Pagamento</label>
            <input type="text" name="formaPgto" class="form-control" value="{{ old('formaPgto') }}" required>
        </div>

        <div class="mb-3">
            <label for="dataCompra">Data da Compra</label>
            <input type="date" name="dataCompra" class="form-control" value="{{ old('dataCompra') }}" required>
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
        <a href="{{ route('produtos.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>
@endsection
