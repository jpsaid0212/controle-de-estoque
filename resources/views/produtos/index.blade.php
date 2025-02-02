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
    }

    h1 {
        text-align: center;
        font-size: 2.5rem;
        font-weight: bold;
        text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
        margin-bottom: 20px;
    }

    .btn-primary {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1rem;
        padding: 10px 20px;
        transition: all 0.3s ease-in-out;
        background-color: #33b101;
        border: none;
    }

    .btn-primary i {
        font-size: 1.2rem;
    }

    .btn-primary:hover {
        transform: scale(1.05);
        box-shadow: 0px 5px 10px rgba(255, 255, 255, 0.3);
    }

    .table {
        background-color: rgba(0, 0, 0, 0.2);
        border-radius: 10px;
        overflow: hidden;
    }

    .table thead {
        background-color: #2b9900;
        color: #fff;
        font-size: 1.1rem;
    }

    .table tbody tr {
        background-color: rgb(63, 61, 61);
        transition: background 0.3s ease-in-out;
    }

    .table tbody tr:hover {
        background-color: rgb(83, 83, 83);
    }

    .btn-warning, .btn-danger {
        font-size: 0.9rem;
        padding: 5px 12px;
        border-radius: 6px;
        transition: transform 0.2s ease-in-out, background 0.3s ease-in-out;
    }

    .btn-warning {
        background-color: #ffb300;
        border: none;
    }

    .btn-danger {
        background-color: #d32f2f;
        border: none;
    }

    .btn-warning:hover {
        transform: scale(1.1);
        background-color: #ff9800;
    }

    .btn-danger:hover {
        transform: scale(1.1);
        background-color: #b71c1c;
    }

    /* Estilizando os ícones */
    .btn i {
        margin-right: 5px;
    }

</style>


    <h1>Lista de Produtos</h1>

    <a href="{{ route('produtos.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Adicionar Produto
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped table-hover table-dark">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Quantidade</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produtos as $produto)
            <tr>
                <td>{{ $produto->nome }}</td>
                <td>{{ $produto->categoria->nome }}</td>
                <td>{{ $produto->quantidade }}</td>
                <td>R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                <td>
                    <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                    <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i> Excluir
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>


<!-- Importando Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

@endsection
