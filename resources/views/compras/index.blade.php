@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Lista de Compras</h2>
        <a href="{{ route('compras.create') }}" class="btn btn-success">Novo Compra</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($compras->count())
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Forma de Pagamento</th>
                    <th>Data da Compra</th>
                    <th>Data do Recebimento</th>
                    <th>Foto</th>
                    <th width="180">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($compras as $compra)
                    <tr>
                        <td>{{ $compra->id }}</td>
                        <td>{{ $compra->formaPgto }}</td>
                        <td>{{ \Carbon\Carbon::parse($compra->dataCompra)->format('d/m/Y') }}</td>
                        <td>
                            {{ $compra->dataRecebto ? \Carbon\Carbon::parse($compra->dataRecebto)->format('d/m/Y') : 'Não recebido' }}
                        </td>
                        <td>
                            @if($compra->foto)
                                <img src="{{ asset('storage/' . $compra->foto) }}" alt="Foto" 
                                     class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;">
                            @else
                                <img src="{{ asset('storage/sem-img.png') }}" alt="Foto" 
                                     class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;">
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('compras.show', $compra->id) }}" class="btn btn-sm btn-primary">Ver</a>
                            <a href="{{ route('compras.edit', $compra->id) }}" class="btn btn-sm btn-warning text-white">Editar</a>
                            <form action="{{ route('compras.destroy', $compra->id) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Tem certeza que deseja excluir este compra?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Paginação -->
        <div class="d-flex justify-content-center">
            {{ $compras->links() }}
        </div>
    @else
        <p class="text-center">Nenhum compra encontrado.</p>
    @endif
</div>
@endsection
