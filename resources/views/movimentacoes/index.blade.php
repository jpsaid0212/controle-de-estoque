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

    .table {
        background-color: rgba(0, 0, 0, 0.2);
        border-radius: 10px;
        overflow: hidden;
    }

    .table thead {
        background-color: #1a5303;
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

    .badge {
        font-size: 1rem;
        padding: 5px 10px;
        border-radius: 5px;
    }

    .bg-success {
        background-color: #2d7b05 !important;
    }

    .bg-danger {
        background-color: #b71c1c !important;
    }

    /* Mensagens de alerta estilizadas */
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


    <h1 class="mb-4">Movimentações de Estoque</h1>

    <a href="{{ route('movimentacoes.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Nova Movimentação
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-striped table-hover table-dark">
        <thead>
            <tr>
                <th>Produto</th>
                <th>Tipo</th>
                <th>Quantidade</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
            @foreach($movimentacoes as $movimentacao)
            <tr>
                <td>{{ $movimentacao->produto->nome }}</td>
                <td>
                    <span class="badge bg-{{ $movimentacao->tipo == 'entrada' ? 'success' : 'danger' }}">
                        {{ ucfirst($movimentacao->tipo) }}
                    </span>
                </td>
                <td>{{ $movimentacao->quantidade }}</td>
                <td>{{ $movimentacao->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>


<!-- Importando Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

@endsection
