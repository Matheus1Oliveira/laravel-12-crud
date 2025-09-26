@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Lista de Compras</h2>

        {{-- Somente usuários logados podem criar novas compras --}}
        @auth
            <a href="{{ route('compras.create') }}" class="btn btn-success">Nova Compra</a>
        @endauth
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($compras->count())
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Forma de Pagamento</th>
                    <th>Data da Compra</th>
                    <th>Data de Recebimento</th>
                    <th>Foto</th>
                    <th class="text-center" width="220">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($compras as $compra)
                    <tr>
                        <td>{{ $compra->id }}</td>
                        <td>{{ $compra->formaPgto }}</td>
                        <td>{{ \Carbon\Carbon::parse($compra->dataCompra)->format('d/m/Y') }}</td>
                        <td>
                            {{ $compra->dataRecebto 
                                ? \Carbon\Carbon::parse($compra->dataRecebto)->format('d/m/Y') 
                                : 'Não recebido' }}
                        </td>
                        <td>
                            @if($compra->foto)
                                <img src="{{ asset('storage/' . $compra->foto) }}" 
                                    alt="Foto da compra" 
                                    class="img-thumbnail img-fluid"
                                    style="max-width: 120px; height: auto; object-fit: cover;">
                            @else
                                <img src="{{ asset('sem-img.png') }}" 
                                    alt="Sem imagem" 
                                    class="img-thumbnail img-fluid"
                                    style="max-width: 120px; height: auto; object-fit: cover;">
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                {{-- Todos podem ver --}}
                                @auth
                                    <a href="{{ route('compras.show', $compra->id) }}" 
                                    class="btn btn-sm btn-primary text-white">
                                        <i class="bi bi-eye"></i> Ver
                                    </a>

                                    <a href="{{ route('compras.edit', $compra->id) }}" 
                                    class="btn btn-sm btn-warning text-white">
                                        <i class="bi bi-pencil-square"></i> Editar
                                    </a>

                                    <form action="{{ route('compras.destroy', $compra->id) }}" 
                                        method="POST" 
                                        class="d-inline"
                                        onsubmit="return confirm('Tem certeza que deseja excluir esta compra?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i> Excluir
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('compras.show', $compra->id) }}" 
                                    class="btn btn-primary text-white w-100">
                                        <i class="bi bi-eye"></i> Ver
                                    </a>
                                @endauth
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center">
        {{ $compras->links() }}
    </div>
    @else
        <p class="text-center">Nenhuma compra encontrada.</p>
    @endif
</div>
@endsection
