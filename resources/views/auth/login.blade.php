@extends('layouts.layout')

@section('content')
<style>
    .login-container {
        background: rgba(53, 53, 53, 0.9);
        padding: 30px;
        border-radius: 10px;
        width: 40%;
        margin: auto;
        margin-top: 50px;
        text-align: center;
    }

    .btn-auth {
        width: 100%;
    }
</style>

<div class="login-container">
    <h2>Login</h2>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">E-mail</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Senha</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary btn-auth">Entrar</button>
    </form>
    <a href="{{ route('register') }}" class="d-block mt-3">Não tem uma conta? Cadastre-se</a>
</div>
@endsection
