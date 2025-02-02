<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Estoque</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Font Awesome para Ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Estilos Customizados -->
    <style>
        body {
            background: linear-gradient(90deg, #000000, #353535);
            color: rgb(255, 255, 255);
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            transition: all 0.3s ease-in-out;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            height: 100vh;
            background: #222;
            position: fixed;
            top: 0;
            left: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between; /* Empurra o botão para baixo */
            transition: all 0.3s ease-in-out;
        }

        .sidebar.closed {
            width: 0;
            padding: 0;
            overflow: hidden;
        }

        .sidebar .logo {
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            color: #fff;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .sidebar .nav-link {
            color: #bbb;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            border-radius: 5px;
            transition: all 0.3s ease-in-out;
        }

        .sidebar .nav-link:hover {
            background: #1a5303;
            color: #fff;
            transform: scale(1.05);
        }

        .sidebar .nav-link i {
            font-size: 1.2rem;
        }

        /* Botão de Perfil */
        .sidebar .profile-btn {
            background: #1a5303;
            color: white;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin-top: auto; /* Empurra o botão para o final */
            transition: all 0.3s ease-in-out;
        }

        .sidebar .profile-btn:hover {
            background: #2d7b05;
            transform: scale(1.05);
        }

        /* Botão de Toggle */
        .sidebar-toggle {
            position: fixed;
            top: 10px;
            left: 260px;
            background: #1a5303;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            z-index: 1000;
        }

        .sidebar.closed + .sidebar-toggle {
            left: 10px;
        }

        .sidebar-toggle:hover {
            background: #2d7b05;
        }

        /* Ajustando o conteúdo */
        .content {
            margin-left: 250px;
            padding: 20px;
            flex-grow: 1;
            transition: all 0.3s ease-in-out;
            width: calc(100% - 250px);
        }

        .sidebar.closed ~ .content {
            margin-left: 0;
            width: 100%;
        }

        /* Responsivo */
        @media (max-width: 768px) {
            .sidebar {
                width: 250px;
                padding: 20px;
            }

            .sidebar.closed {
                width: 0;
                padding: 0;
            }

            .content {
                margin-left: 250px;
                width: calc(100% - 250px);
            }

            .sidebar.closed ~ .content {
                margin-left: 0;
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div>
            <div class="logo">
                <i class="fas fa-boxes"></i> Controle de Estoque
            </div>

            <a href="/dashboard" class="nav-link"><i class="fas fa-chart-line"></i> Dashboard</a>
            <a href="/produtos" class="nav-link"><i class="fas fa-box"></i> Produtos</a>
            <a href="/fornecedores" class="nav-link"><i class="fas fa-truck"></i> Fornecedores</a>
            <a href="/categorias" class="nav-link"><i class="fas fa-tags"></i> Categorias</a>
            <a href="/movimentacoes" class="nav-link"><i class="fas fa-exchange-alt"></i> Movimentações</a>
        </div>

        <!-- Botão de Perfil -->
        <a href="{{ route('profile.edit') }}" class="profile-btn mb-2">
            <i class="fas fa-user"></i> Perfil
        </a>
        
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger w-100">
                <i class="fas fa-sign-out-alt"></i> Sair
            </button>
        </form>
    </div>

    <!-- Botão de Toggle -->
    <button class="sidebar-toggle" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Conteúdo da Página -->
    <div class="content">
        <div class="container mt-4">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script para Toggle da Sidebar -->
    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('closed');
        }
    </script>

</body>
</html>
