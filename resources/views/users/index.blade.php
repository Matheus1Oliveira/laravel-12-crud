@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Gerenciar Usuários</h2>
        <a href="{{ route('register') }}" class="btn btn-success">Novo Usuário</a>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">{{ $message }}</div>
    @endif

    @if($users->count())
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th class="text-center">ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th class="text-center">Foto</th>
                    <th class="text-center" width="220">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td class="text-center">{{ ++$i }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td class="text-center">
                        @if($user->foto)
                            <img src="{{ asset('storage/' . $user->foto) }}" 
                                 alt="Foto do usuário" 
                                 class="img-thumbnail img-fluid"
                                 style="max-width: 80px; height: auto; object-fit: cover;">
                        @else
                            <img src="{{ asset('sem-img.png') }}" 
                                 alt="Sem foto" 
                                 class="img-thumbnail img-fluid"
                                 style="max-width: 80px; height: auto; object-fit: cover;">
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('users.show', $user->id) }}" 
                               class="btn btn-sm btn-primary">
                                <i class="bi bi-eye"></i> Ver
                            </a>

                            <a href="{{ route('users.edit', $user->id) }}" 
                               class="btn btn-sm btn-warning text-white">
                                <i class="bi bi-pencil-square"></i> Editar
                            </a>

                            <form action="{{ route('users.destroy',$user->id) }}" 
                                  method="POST" 
                                  class="d-inline"
                                  onsubmit="return confirm('Deseja realmente excluir este usuário?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i> Excluir
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{ $users->links() }}
    </div>
    @else
        <p class="text-center">Nenhum usuário encontrado.</p>
    @endif
</div>
@endsection
