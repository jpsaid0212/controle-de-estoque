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

    .btn-primary {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1rem;
        padding: 10px 20px;
        transition: all 0.3s ease-in-out;
        background-color: #1a5303;
        border: none;
    }

    .btn-primary i {
        font-size: 1.2rem;
    }

    .btn-primary:hover {
        transform: scale(1.05);
        box-shadow: 0px 5px 10px rgba(255, 255, 255, 0.3);
    }

    /* Tabela */
    .table {
        background-color: rgba(100, 100, 100, 0.3); /* Cinza mais suave */
        border-radius: 10px;
        overflow: hidden;
    }

    .table thead {
        background-color: rgba(80, 80, 80, 0.9); /* Cinza escuro */
        color: #fff;
        font-size: 1.1rem;
    }

    .table tbody tr {
        background-color: rgba(90, 90, 90, 0.4); /* Cinza médio */
        transition: background 0.3s ease-in-out;
    }

    .table tbody tr:hover {
        background-color: rgba(120, 120, 120, 0.5); /* Cinza mais claro no hover */
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

    /* Mensagem de sucesso estilizada */
    .alert {
        border-radius: 6px;
        font-size: 1rem;
        text-align: center;
        padding: 10px;
        margin-bottom: 20px;
    }

    /* Animação de entrada */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }

</style>


    <h1 class="mb-4">Lista de Fornecedores</h1>

    <a href="{{ route('fornecedores.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Adicionar Fornecedor
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped table-hover table-dark">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fornecedores as $fornecedor)
            <tr>
                <td>{{ $fornecedor->nome }}</td>
                <td>{{ $fornecedor->email }}</td>
                <td>{{ $fornecedor->telefone }}</td>
                <td>
                    <a href="{{ route('fornecedores.edit', $fornecedor->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                    <form action="{{ route('fornecedores.destroy', $fornecedor->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i> Excluir
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Importando Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

@endsection
