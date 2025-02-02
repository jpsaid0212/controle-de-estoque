@extends('layouts.layout')

@section('content')
<style>
    .register-container {
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

<div class="register-container">
    <h2>Cadastro</h2>
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">E-mail</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Senha</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Confirmar Senha</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success btn-auth">Cadastrar</button>
    </form>
    <a href="{{ route('login') }}" class="d-block mt-3">Já tem uma conta? Faça login</a>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.querySelector("form");
        form.addEventListener("submit", function (event) {
            event.preventDefault(); // Previne envio automático para inspecionar os dados

            let formData = new FormData(form);
            let data = Object.fromEntries(formData.entries());

            console.log("📩 Dados Enviados:", data);

            fetch(form.action, {
                method: form.method,
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                }
            })
            .then(response => response.json())
            .then(result => console.log("✅ Resposta do Servidor:", result))
            .catch(error => console.error("❌ Erro na Requisição:", error));

            form.submit(); // Após log, submete o formulário normalmente
        });
    });
</script>

@endsection
