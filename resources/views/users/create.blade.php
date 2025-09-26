@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Adicionar Usuário</h2>
    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Nome:</label>
            <input type="text" name="name" class="form-control" placeholder="Nome" maxlength="40">
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" placeholder="Email">
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label>Senha:</label>
            <input type="password" name="password" class="form-control" placeholder="Senha">
            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" name="foto" id="foto" class="form-control">
            
            @if(isset($user) && $user->foto)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $user->foto) }}" 
                        alt="Foto do usuário" 
                        class="img-thumbnail"
                        style="width: 100px; height: 100px; object-fit: cover;">
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a class="btn btn-secondary" href="{{ route('users.index') }}">Voltar</a>
    </form>
</div>
@endsection
