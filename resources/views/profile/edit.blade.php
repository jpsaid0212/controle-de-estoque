@extends('layouts.layout')

@section('content')
<style>
    .profile-container {
        background: rgba(53, 53, 53, 0.9);
        padding: 30px;
        border-radius: 10px;
        width: 50%;
        margin: auto;
        margin-top: 50px;
        text-align: center;
    }

    .btn-auth {
        width: 100%;
    }
</style>

<div class="profile-container">
    <h2>Editar Perfil</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">E-mail</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nova Senha (opcional)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Confirmar Nova Senha</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-success btn-auth">Atualizar Perfil</button>
    </form>

    <form action="{{ route('profile.destroy') }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir sua conta?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-auth mt-3">Excluir Conta</button>
    </form>
</div>
@endsection
