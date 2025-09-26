@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Lista de Produtos</h2>

        {{-- Somente logados podem criar produtos --}}
        @auth
            <a href="{{ route('products.create') }}" class="btn btn-success">Novo Produto</a>
        @endauth
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($products->count())
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th scope="col" class="text-center">ID</th>
                    <th scope="col">Código</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Preço</th>
                    <th scope="col" class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td class="text-center">{{ $product->id }}</td>
                        <td>{{ $product->code }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                {{-- Todos podem ver --}}
                                @auth
                                    <a href="{{ route('products.show', $product->id) }}" 
                                    class="btn btn-primary btn-sm">
                                        <i class="bi bi-eye"></i> Ver
                                    </a>

                                    <a href="{{ route('products.edit', $product->id) }}" 
                                    class="btn btn-warning btn-sm text-white">
                                        <i class="bi bi-pencil-square"></i> Editar
                                    </a>   

                                    <form action="{{ route('products.destroy', $product->id) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Deseja realmente excluir este produto?');">
                                            <i class="bi bi-trash"></i> Excluir
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('products.show', $product->id) }}" 
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
            {{ $products->links() }}
        </div>
    @else
        <p class="text-center">Nenhum produto encontrado.</p>
    @endif
</div>
@endsection
