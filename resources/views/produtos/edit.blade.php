@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Produto #{{ $produto->id }}</h2>

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

    <form action="{{ route('produtos.update', $produto->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="formaPgto">Forma de Pagamento</label>
            <input type="text" name="formaPgto" class="form-control"
                   value="{{ old('formaPgto', $produto->formaPgto) }}" required>
        </div>

        <div class="mb-3">
            <label for="dataCompra">Data da Compra</label>
            <input type="date" name="dataCompra" class="form-control"
                   value="{{ old('dataCompra', optional($produto->dataCompra)->format('Y-m-d')) }}" required>
        </div>

        <div class="mb-3">
            <label for="dataRecebto">Data de Recebimento</label>
            <input type="date" name="dataRecebto" class="form-control"
                   value="{{ old('dataRecebto', optional($produto->dataRecebto)->format('Y-m-d')) }}">
        </div>

        <div class="mb-3">
            <label for="obs">Observações</label>
            <textarea name="obs" class="form-control">{{ old('obs', $produto->obs) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="foto">Foto</label>
            <input type="file" name="foto" class="form-control">
            @if ($produto->foto)
                <p>Foto atual:</p>
                <img src="{{ asset('storage/' . $produto->foto) }}" width="150">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="{{ route('produtos.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>
@endsection
