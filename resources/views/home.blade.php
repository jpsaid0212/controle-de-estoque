@extends('layouts.layout')

@section('content')
<!-- Importando Font Awesome para os ícones -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<style>
    body {
        background: linear-gradient(90deg, #000000, #353535);
        color: rgb(255, 255, 255);
        font-family: 'Arial', sans-serif;
        margin: 0;
        overflow-x: hidden;
    }

    .hero-section {
        text-align: center;
        padding: 80px 20px;
        animation: fadeIn 1.5s ease-in-out;
    }

    h1 {
        font-size: 3rem;
        font-weight: bold;
        text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3);
        animation: slideInFromTop 1s ease-out;
    }

    .lead {
        font-size: 1.3rem;
        margin-bottom: 30px;
        animation: fadeIn 2s ease-in-out;
    }

    .btn-container {
        display: flex;
        justify-content: center;
        gap: 15px;
        flex-wrap: wrap;
    }

    .btn-custom {
        font-size: 1.2rem;
        padding: 12px 25px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 10px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .btn-custom:hover {
        transform: scale(1.1);
        box-shadow: 0px 10px 15px rgba(0, 0, 0, 0.2);
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideInFromTop {
        from { transform: translateY(-50px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    .container {
        background-color: #00000069;
        padding: 30px;
        border-radius: 10px;
        text-align: center;
        margin-top: 20px;
    }
</style>

<div class="hero-section">
    <h1>Bem-vindo ao Controle de Estoque</h1>
    <p class="lead">Acesse sua conta para gerenciar seus produtos, fornecedores e categorias de forma eficiente.</p>
</div>


    <div class="btn-container">
        <a href="{{ route('login') }}" class="btn btn-primary btn-lg btn-custom">
            <i class="fas fa-sign-in-alt"></i> Fazer Login
        </a>
    </div>


<script>
    // Pequena animação ao carregar a página
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelector('.hero-section').style.opacity = "1";
    });
</script>

@endsection
