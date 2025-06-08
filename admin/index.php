<?php
// Inicia a sessão de forma segura
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Verifica se o usuário é administrador
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_id'] != 1) {
    header('Location: ../catalogo.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Admin - Catálogo de Peixes</title>
    <style>
        :root {
            --primary-color: #166088;
            --secondary-color: #4a6fa5;
            --aqua-color: #17a2b8;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --light-color: #f8f9fa;
            --border-radius: 8px;
            --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        body {
            background-color: #e6f2ff;
            color: #333;
            line-height: 1.6;
            background-image: linear-gradient(to bottom, #e6f2ff, #cce6ff);
        }

        .admin-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 2rem;
        }

        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--primary-color);
        }

        .admin-title {
            color: var(--primary-color);
            font-size: 2rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .admin-title i {
            font-size: 1.8rem;
        }

        .logout-btn {
            background-color: var(--danger-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: var(--border-radius);
            text-decoration: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .logout-btn:hover {
            background-color: #c82333;
            transform: translateY(-2px);
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .dashboard-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 1.5rem;
            transition: all 0.3s ease;
            text-align: center;
            border-top: 4px solid var(--aqua-color);
            position: relative;
            overflow: hidden;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .card-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: var(--primary-color);
        }

        .card-title {
            font-size: 1.2rem;
            margin-bottom: 1rem;
            color: var(--primary-color);
        }

        .card-desc {
            color: #666;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }

        .card-btn {
            display: inline-block;
            padding: 0.6rem 1.2rem;
            background-color: var(--primary-color);
            color: white;
            border-radius: var(--border-radius);
            text-decoration: none;
            transition: all 0.3s ease;
            width: 100%;
            border: none;
            cursor: pointer;
            font-size: 0.95rem;
        }

        .card-btn:hover {
            background-color: var(--secondary-color);
        }

        .btn-public {
            background-color: var(--aqua-color);
        }

        .btn-public:hover {
            background-color: #138496;
        }

        .btn-add {
            background-color: var(--success-color);
        }

        .btn-add:hover {
            background-color: #218838;
        }

        .fish-decoration {
            position: absolute;
            opacity: 0.1;
            font-size: 5rem;
            z-index: 0;
        }

        .fish-1 {
            top: -20px;
            right: -20px;
            transform: rotate(30deg);
            color: var(--primary-color);
        }

        .fish-2 {
            bottom: -30px;
            left: -30px;
            transform: rotate(-15deg);
            color: var(--aqua-color);
        }

        @media (max-width: 768px) {
            .admin-container {
                padding: 1rem;
            }
            
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
            
            .admin-header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }
        }
    </style>
    <!-- Ícones do Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="admin-container">
        <header class="admin-header">
            <h1 class="admin-title">
                <i class="fas fa-fish"></i> Painel de Administração
            </h1>
            <a href="../logout.php" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Sair
            </a>
        </header>

        <div class="dashboard-grid">
            <!-- Catálogo Público -->
            <div class="dashboard-card">
                <i class="fas fa-globe fish-decoration fish-1"></i>
                <div class="card-icon">
                    <i class="fas fa-eye"></i>
                </div>
                <h3 class="card-title">Catálogo Público</h3>
                <p class="card-desc">Visualize como os visitantes veem o catálogo</p>
                <a href="../catalogoPublico.php" class="card-btn btn-public">
                    <i class="fas fa-external-link-alt"></i> Acessar Catálogo
                </a>
            </div>

            <!-- Catálogo Completo -->
            <div class="dashboard-card">
                <i class="fas fa-fish fish-decoration fish-2"></i>
                <div class="card-icon">
                    <i class="fas fa-list"></i>
                </div>
                <h3 class="card-title">Catálogo Administrativo</h3>
                <p class="card-desc">Acesso completo a todas as espécies cadastradas</p>
                <a href="../catalogo.php" class="card-btn">
                    <i class="fas fa-tools"></i> Gerenciar Espécies
                </a>
            </div>

            <!-- Adicionar Espécie -->
            <div class="dashboard-card">
                <i class="fas fa-fish fish-decoration fish-1"></i>
                <div class="card-icon">
                    <i class="fas fa-plus-circle"></i>
                </div>
                <h3 class="card-title">Adicionar Espécie</h3>
                <p class="card-desc">Cadastre uma nova espécie de peixe no sistema</p>
                <a href="adicionarEspecies.php" class="card-btn btn-add">
                    <i class="fas fa-plus"></i> Nova Espécie
                </a>
            </div>

            <!-- Adicionar Usuário -->
            <div class="dashboard-card">
                <i class="fas fa-user-plus fish-decoration fish-2"></i>
                <div class="card-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <h3 class="card-title">Adicionar Usuário</h3>
                <p class="card-desc">Cadastre um novo usuário no sistema</p>
                <a href="cadastrarUsuarios.php" class="card-btn">
                    <i class="fas fa-user-cog"></i> Novo Usuário
                </a>
            </div>
        </div>
    </div>
</body>
</html>