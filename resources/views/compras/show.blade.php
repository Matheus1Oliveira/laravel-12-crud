@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Detalhes da Compra</h2>
        <a href="{{ route('compras.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Voltar
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            {{-- Foto da compra centralizada --}}
            <div class="text-center mb-4">
                @if($compra->foto)
                    <img src="{{ asset('storage/' . $compra->foto) }}" 
                         alt="Foto da compra" 
                         class="img-thumbnail shadow-sm"
                         style="max-width: 250px; height: auto; border-radius: 10px;">
                @else
                    <img src="{{ asset('sem-img.png') }}" 
                         alt="Sem imagem" 
                         class="img-thumbnail shadow-sm"
                         style="max-width: 250px; height: auto; border-radius: 10px;">
                @endif
            </div>

            <div class="mb-3">
                <strong>ID:</strong> {{ $compra->id }}
            </div>

            <div class="mb-3">
                <strong>Forma de Pagamento:</strong> {{ $compra->formaPgto }}
            </div>

            <div class="mb-3">
                <strong>Data da Compra:</strong> {{ \Carbon\Carbon::parse($compra->dataCompra)->format('d/m/Y') }}
            </div>

            <div class="mb-3">
                <strong>Data de Recebimento:</strong> 
                {{ $compra->dataRecebto ? \Carbon\Carbon::parse($compra->dataRecebto)->format('d/m/Y') : 'Não recebido' }}
            </div>

            @if($compra->obs)
                <div class="mb-3">
                    <strong>Observações:</strong>
                    <p class="mt-1">{{ $compra->obs }}</p>
                </div>
            @endif

            <div class="d-flex justify-content-end gap-2 mt-4">
                @auth
                    <a href="{{ route('compras.edit', $compra->id) }}" class="btn btn-warning text-white">
                        <i class="bi bi-pencil-square"></i> Editar
                    </a>

                    <form action="{{ route('compras.destroy', $compra->id) }}" method="POST" 
                          onsubmit="return confirm('Tem certeza que deseja excluir esta compra?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">
                            <i class="bi bi-trash"></i> Excluir
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection
