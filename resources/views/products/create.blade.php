@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Novo produto</h2>

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

    <form action="{{ route('products.store') }}" method="post">
         @csrf

        <div class="mb-3">
            <label for="code">Código</label>
            <input type="text" class="form-control @error('code') is-invalid @enderror"
                id="code" name="code" value="{{ old('code') }}">
            @error('code')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="name">Nome</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror"
                id="name" name="name" value="{{ old('name') }}">
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="quantity">Quantidade</label>
            <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                id="quantity" name="quantity" value="{{ old('quantity') }}">
            @error('quantity')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="price">Preço</label>
            <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror"
                id="price" name="price" value="{{ old('price') }}">
            @error('price')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description">Descrição</label>
            <textarea class="form-control @error('description') is-invalid @enderror"
                    id="description" name="description">{{ old('description') }}</textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
                  
        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>
@endsection