@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Lista de Produtos</h2>
        <a class="btn btn-success" href="{{ route('produtos.create') }}">Novo Produto</a>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Forma de Pagamento</th>
            <th>Data da Compra</th>
            <th>Data de Recebimento</th>
            <th>Ações</th>
        </tr>
        @foreach ($produtos as $produto)
        <tr>
            <td>{{ $produto->id }}</td>
            <td>{{ $produto->formaPgto }}</td>
            <td>{{ $produto->dataCompra }}</td>
            <td>{{ $produto->dataRecebto }}</td>
            <td>
                <a class="btn btn-info btn-sm" href="{{ route('produtos.show', $produto->id) }}">Ver</a>
                <a class="btn btn-primary btn-sm" href="{{ route('produtos.edit', $produto->id) }}">Editar</a>
                <a class="btn btn-success btn-sm" href="{{ route('produtos.compra', $produto->id) }}">Registrar Compra</a>
                <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Tem certeza que deseja deletar este produto?')">Deletar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    {{ $produtos->links() }}
</div>
@endsection
