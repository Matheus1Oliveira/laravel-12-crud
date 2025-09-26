@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Detalhes do Usuário</h2>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Voltar</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body text-center">

            {{-- Foto do usuário --}}
            @if($user->foto)
                <img src="{{ asset('storage/' . $user->foto) }}" 
                     alt="Foto do usuário" 
                     class="rounded-circle shadow mb-3"
                     style="width: 150px; height: 150px; object-fit: cover;">
            @else
                <img src="{{ asset('sem-img.png') }}" 
                     alt="Sem foto" 
                     class="rounded-circle shadow mb-3"
                     style="width: 150px; height: 150px; object-fit: cover;">
            @endif

            <h4 class="mb-3">{{ $user->name }}</h4>

            <div class="row justify-content-center">
                <div class="col-md-6 text-start">
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Admin:</strong> {{ $user->is_admin ? 'Sim' : 'Não' }}</p>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning text-white">
                    <i class="bi bi-pencil-square"></i> Editar
                </a>
                <form action="{{ route('users.destroy', $user->id) }}" 
                      method="POST" 
                      class="d-inline"
                      onsubmit="return confirm('Tem certeza que deseja excluir este usuário?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">
                        <i class="bi bi-trash"></i> Excluir
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
