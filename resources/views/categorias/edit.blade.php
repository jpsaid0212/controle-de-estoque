@extends('layouts.layout')

@section('content')

<style>
    body {
        background: linear-gradient(90deg, #000000, #353535);
        color: rgb(255, 255, 255);
        font-family: 'Arial', sans-serif;
    }

    .container {
        background-color: rgba(53, 53, 53, 0.9);
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
        animation: fadeIn 1s ease-in-out;
    }

    h1 {
        text-align: center;
        font-size: 2.5rem;
        font-weight: bold;
        text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
        margin-bottom: 20px;
    }

    .form-label {
        font-weight: bold;
        color: #fff;
    }

    .form-control {
        background: rgba(255, 255, 255, 0.1);
        border: none;
        border-radius: 6px;
        color: #fff;
        padding: 10px;
        transition: all 0.3s ease-in-out;
    }

    .form-control:focus {
        background: rgba(255, 255, 255, 0.2);
        border: 1px solid #1a5303;
        box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.3);
        color: #fff;
    }

    .btn-success, .btn-secondary {
        font-size: 1rem;
        padding: 10px 20px;
        border-radius: 6px;
        transition: transform 0.3s ease-in-out, background 0.3s ease-in-out;
    }

    .btn-success {
        background-color: #1a5303;
        border: none;
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
    }

    .btn-success:hover {
        transform: scale(1.05);
        background-color: #2d7b05;
    }

    .btn-secondary:hover {
        transform: scale(1.05);
        background-color: #5a6268;
    }

    /* Animação de entrada */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }

</style>


    <h1>Editar Categoria</h1>
    
    <form action="{{ route('categorias.update', $categoria->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nome da Categoria</label>
            <input type="text" name="nome" class="form-control" value="{{ $categoria->nome }}" required>
        </div>
        <button type="submit" class="btn btn-success">
            <i class="fas fa-save"></i> Atualizar
        </button>
        <a href="{{ route('categorias.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Voltar
        </a>
    </form>


<!-- Importando Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

@endsection
