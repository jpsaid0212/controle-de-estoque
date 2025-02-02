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
        color: #000000;
    }

    .btn-primary, .btn-secondary {
        font-size: 1rem;
        padding: 10px 20px;
        border-radius: 6px;
        transition: transform 0.3s ease-in-out, background 0.3s ease-in-out;
    }

    .btn-primary {
        background-color: #1a5303;
        border: none;
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
    }

    .btn-primary:hover {
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


    <h1>Editar Produto</h1>

    <form action="{{ route('produtos.update', $produto->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" value="{{ $produto->nome }}" required>
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea name="descricao" id="descricao" class="form-control">{{ $produto->descricao }}</textarea>
        </div>

        <div class="mb-3">
            <label for="categoria_id" class="form-label">Categoria</label>
            <select name="categoria_id" id="categoria_id" class="form-control">
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ $produto->categoria_id == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="fornecedor_id" class="form-label">Fornecedor</label>
            <select name="fornecedor_id" id="fornecedor_id" class="form-control">
                <option value="">Nenhum</option>
                @foreach($fornecedores as $fornecedor)
                    <option value="{{ $fornecedor->id }}" {{ $produto->fornecedor_id == $fornecedor->id ? 'selected' : '' }}>
                        {{ $fornecedor->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="quantidade" class="form-label">Quantidade</label>
            <input type="number" name="quantidade" id="quantidade" class="form-control" value="{{ $produto->quantidade }}" required>
        </div>

        <div class="mb-3">
            <label for="preco" class="form-label">Preço</label>
            <input type="text" name="preco" id="preco" class="form-control" value="{{ $produto->preco }}" required>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Atualizar Produto
        </button>
        <a href="{{ route('produtos.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Voltar
        </a>
    </form>


<!-- Importando Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

@endsection
