<?php
// header.php - Cabeçalho reutilizável para o site PeixeBiota

// Inicia a sessão se ainda não estiver ativa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'PeixeBiota - Catálogo de Espécies Aquáticas'; ?></title>
    <style>
        :root {
            --primary-color: #166088;
            --secondary-color: #4a6fa5;
            --aqua-color: #17a2b8;
            --light-aqua: #e6f7ff;
            --white: #ffffff;
            --dark-blue: #0d3c5f;
            --success-color: #28a745;
            --border-radius: 8px;
            --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        header {
            background-color: var(--white);
            box-shadow: var(--box-shadow);
            padding: 1rem 0;
            position: relative;
            top: 0;
            z-index: 100;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .logo-icon {
            color: var(--primary-color);
            font-size: 2rem;
        }

        .logo-text {
            color: var(--dark-blue);
            font-weight: 700;
            font-size: 1.5rem;
        }

        .nav-links {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }

        .nav-link {
            color: var(--dark-blue);
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: var(--border-radius);
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: var(--primary-color);
            background-color: rgba(22, 96, 136, 0.1);
        }

        .btn {
            display: inline-block;
            padding: 0.6rem 1.2rem;
            border-radius: var(--border-radius);
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: var(--white);
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .user-greeting {
            font-weight: 500;
            color: var(--dark-blue);
            margin-right: 0.5rem;
        }

        @media (max-width: 768px) {
            .nav-container {
                flex-direction: column;
                gap: 1rem;
                padding: 1rem;
            }
            
            .nav-links {
                width: 100%;
                justify-content: center;
                flex-wrap: wrap;
            }
        }
    </style>
    <!-- Ícones do Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <div class="nav-container">
            <a href="index.php" class="logo">
                <i class="fas fa-fish logo-icon"></i>
                <span class="logo-text">CaruMar</span>
            </a>
            <div class="nav-links">
                <a href="index.php" class="nav-link">Início</a>
                <a href="catalogoPublico.php" class="nav-link">Catálogo</a>
                <a href="sobre.php" class="nav-link">Sobre</a>
                
                <?php if (isset($_SESSION['usuario_id'])): ?>
                    <span class="user-greeting">Olá, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</span>
                    <a href="admin/" class="btn btn-primary">
                        <i class="fas fa-tachometer-alt"></i> Painel
                    </a>
                    <a href="logout.php" class="btn btn-primary" style="background-color: var(--aqua-color);">
                        <i class="fas fa-sign-out-alt"></i> Sair
                    </a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-primary">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <main>  <!-- Tag main aberta para fechar nas páginas que incluírem o header -->