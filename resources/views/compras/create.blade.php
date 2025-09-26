@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Nova Compra</h2>
        <a href="{{ route('compras.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Voltar
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Ops!</strong> Verifique os erros abaixo:
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('compras.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="formaPgto" class="form-label">Forma de Pagamento</label>
                    <select name="formaPgto" id="formaPgto" 
                            class="form-select @error('formaPgto') is-invalid @enderror" required>
                        <option value="" disabled {{ old('formaPgto') ? '' : 'selected' }}>Selecione...</option>
                        <option value="Boleto" {{ old('formaPgto') == 'Boleto' ? 'selected' : '' }}>Boleto</option>
                        <option value="Cartão de Crédito" {{ old('formaPgto') == 'Cartão de Crédito' ? 'selected' : '' }}>Cartão de Crédito</option>
                        <option value="PIX" {{ old('formaPgto') == 'PIX' ? 'selected' : '' }}>PIX</option>
                        <option value="Dinheiro" {{ old('formaPgto') == 'Dinheiro' ? 'selected' : '' }}>Dinheiro</option>
                    </select>
                    @error('formaPgto')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="dataCompra" class="form-label">Data da Compra</label>
                    <input type="date" 
                           class="form-control @error('dataCompra') is-invalid @enderror" 
                           id="dataCompra" name="dataCompra" 
                           value="{{ old('dataCompra', now()->format('Y-m-d')) }}" required>
                    @error('dataCompra')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="dataRecebto" class="form-label">Data de Recebimento</label>
                    <input type="date" 
                           class="form-control @error('dataRecebto') is-invalid @enderror" 
                           id="dataRecebto" name="dataRecebto" 
                           value="{{ old('dataRecebto') }}">
                    @error('dataRecebto')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="obs" class="form-label">Observações</label>
                    <textarea class="form-control @error('obs') is-invalid @enderror" 
                              id="obs" name="obs" rows="3">{{ old('obs') }}</textarea>
                    @error('obs')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" 
                           class="form-control @error('foto') is-invalid @enderror" 
                           id="foto" name="foto">
                    @error('foto')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Script para garantir que a data de recebimento seja >= data da compra --}}
<script>
    const dataCompra = document.getElementById('dataCompra');
    const dataRecebto = document.getElementById('dataRecebto');

    function ajustarMinimo() {
        if (dataCompra.value) {
            dataRecebto.min = dataCompra.value;
        }
    }

    dataCompra.addEventListener('change', ajustarMinimo);
    window.addEventListener('load', ajustarMinimo);
</script>
@endsection
