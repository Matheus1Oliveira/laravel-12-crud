@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Editar Usuário</h2>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Voltar</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Foto atual centralizada --}}
                @if($user->foto)
                    <div class="text-center mb-4">
                        <img src="{{ asset('storage/' . $user->foto) }}" 
                             alt="Foto do usuário" 
                             class="rounded-circle shadow"
                             style="width: 120px; height: 120px; object-fit: cover;">
                    </div>
                @endif

                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" 
                           class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ old('name', $user->name) }}">
                    @error('name')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" value="{{ old('email', $user->email) }}">
                    @error('email')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Senha (opcional)</label>
                    <input type="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           id="password" name="password">
                    @error('password')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Deixe em branco para não alterar</small>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirmar Senha</label>
                    <input type="password" 
                           class="form-control" 
                           id="password_confirmation" name="password_confirmation">
                </div>

                <div class="mb-3">
                    <label for="foto" class="form-label">Alterar Foto</label>
                    <input type="file" 
                           class="form-control @error('foto') is-invalid @enderror" 
                           id="foto" name="foto">
                    @error('foto')
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
