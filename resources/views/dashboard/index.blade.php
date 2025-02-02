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

    /* Estilização dos Cards */
    .dashboard-card {
        background-color: rgba(0, 0, 0, 0.6);
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.5);
        transition: transform 0.3s ease-in-out;
        color: white;
    }

    .dashboard-card:hover {
        transform: scale(1.05);
    }

    .dashboard-card i {
        font-size: 2.5rem;
        margin-bottom: 10px;
    }

    .dashboard-card h3 {
        font-size: 1.5rem;
        margin: 10px 0;
    }

    .dashboard-card p {
        font-size: 1.2rem;
    }

    /* Gráfico */
    .chart-container {
        background-color: rgba(0, 0, 0, 0.6);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.5);
        text-align: center;
    }

    /* Animação de entrada */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="container mt-4">
    <h1>Dashboard</h1>

    <div class="row">
        <!-- Card de Produtos -->
        <div class="col-md-3">
            <div class="dashboard-card">
                <i class="fas fa-box"></i>
                <h3>Produtos</h3>
                <p>{{ $totalProdutos }}</p>
            </div>
        </div>

        <!-- Card de Fornecedores -->
        <div class="col-md-3">
            <div class="dashboard-card">
                <i class="fas fa-truck"></i>
                <h3>Fornecedores</h3>
                <p>{{ $totalFornecedores }}</p>
            </div>
        </div>

        <!-- Card de Categorias -->
        <div class="col-md-3">
            <div class="dashboard-card">
                <i class="fas fa-tags"></i>
                <h3>Categorias</h3>
                <p>{{ $totalCategorias }}</p>
            </div>
        </div>

        <!-- Card de Movimentações -->
        <div class="col-md-3">
            <div class="dashboard-card">
                <i class="fas fa-exchange-alt"></i>
                <h3>Movimentações</h3>
                <p>{{ $totalMovimentacoes }}</p>
            </div>
        </div>
    </div>

    <!-- Gráfico de Produtos Mais Vendidos -->
    <div class="mt-4 chart-container">
        <h3>Produtos Mais Vendidos</h3>
        <canvas id="produtosVendidosChart"></canvas>
    </div>

    <!-- Gráfico de Movimentações por Mês -->
    <div class="mt-4 chart-container">
        <h3>Movimentações dos Últimos 6 Meses</h3>
        <canvas id="movimentacoesMesesChart"></canvas>
    </div>
</div>

<!-- Importação do Chart.js para gerar os gráficos -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
   document.addEventListener("DOMContentLoaded", function () {
    fetch("{{ route('dashboard.chart-data') }}") // Agora usa a rota correta
        .then(response => response.json())
        .then(data => {
            console.log("Dados do gráfico:", data); // Teste no console para ver os dados retornados

            // 📊 Gráfico de Produtos Mais Vendidos
            var ctx1 = document.getElementById('produtosVendidosChart').getContext('2d');
            var produtosVendidosChart = new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: data.produtosMaisVendidos.map(item => item.produto.nome),
                    datasets: [{
                        label: 'Quantidade Vendida',
                        data: data.produtosMaisVendidos.map(item => item.total_vendido),
                        backgroundColor: '#1a5303'
                    }]
                }
            });

            // 📈 Gráfico de Movimentações por Mês
            var ctx2 = document.getElementById('movimentacoesMesesChart').getContext('2d');
            var movimentacoesMesesChart = new Chart(ctx2, {
                type: 'line',
                data: {
                    labels: data.movimentacoesMeses.map(item => item.mes + '/' + item.ano),
                    datasets: [
                        {
                            label: 'Entradas',
                            data: data.movimentacoesMeses.map(item => item.total_entradas),
                            borderColor: '#2d7b05',
                            fill: false
                        },
                        {
                            label: 'Saídas',
                            data: data.movimentacoesMeses.map(item => item.total_saidas),
                            borderColor: '#d32f2f',
                            fill: false
                        }
                    ]
                }
            });
        })
        .catch(error => console.error("Erro ao carregar dados do gráfico:", error));
});

</script>

<!-- Importação do Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

@endsection
