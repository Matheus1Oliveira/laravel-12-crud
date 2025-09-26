@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Editar Produto</h2>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Voltar
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Ops!</strong> Verifique os erros abaixo:<br><br>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('products.update', $product->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="code" class="form-label">Código</label>
                    <input type="text" 
                           class="form-control @error('code') is-invalid @enderror"
                           id="code" name="code" 
                           value="{{ old('code', $product->code) }}">
                    @error('code')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" 
                           class="form-control @error('name') is-invalid @enderror"
                           id="name" name="name" 
                           value="{{ old('name', $product->name) }}">
                    @error('name')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantidade</label>
                    <input type="number" 
                           class="form-control @error('quantity') is-invalid @enderror"
                           id="quantity" name="quantity" 
                           value="{{ old('quantity', $product->quantity) }}">
                    @error('quantity')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Preço</label>
                    <input type="number" step="0.01" 
                           class="form-control @error('price') is-invalid @enderror"
                           id="price" name="price" 
                           value="{{ old('price', $product->price) }}">
                    @error('price')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Descrição</label>
                    <textarea class="form-control @error('description') is-invalid @enderror"
                              id="description" name="description">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Atualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
