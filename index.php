<?php 
// Defina o título da página antes de incluir o header
$pageTitle = "CaruMar - Catálogo de Espécies Aquáticas"; 
include 'header.php'; 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="icone.png" type="image/x-icon">
    <title>CaruMar - Catálogo de Espécies Aquáticas</title>
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

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        body {
            background-color: var(--light-aqua);
            color: #333;
            line-height: 1.6;
            background-image: linear-gradient(to bottom, var(--light-aqua), #cce6ff);
            min-height: 100vh;
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

        .hero {
            max-width: 1200px;
            margin: 3rem auto;
            padding: 0 2rem;
            display: flex;
            align-items: center;
            gap: 3rem;
        }

        .hero-content {
            flex: 1;
        }

        .hero-title {
            font-size: 2.5rem;
            color: var(--dark-blue);
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .hero-text {
            font-size: 1.1rem;
            color: #555;
            margin-bottom: 2rem;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .hero-image {
            flex: 1;
            text-align: center;
        }

        .hero-img {
            max-width: 100%;
            height: auto;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        .features {
            max-width: 1200px;
            margin: 4rem auto;
            padding: 0 2rem;
        }

        .section-title {
            text-align: center;
            font-size: 2rem;
            color: var(--dark-blue);
            margin-bottom: 3rem;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            background-color: var(--white);
            padding: 2rem;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            text-align: center;
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .feature-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
        }

        .feature-title {
            font-size: 1.3rem;
            color: var(--dark-blue);
            margin-bottom: 1rem;
        }

        .feature-text {
            color: #666;
        }

        footer {
            background-color: var(--dark-blue);
            color: var(--white);
            padding: 3rem 2rem;
            text-align: center;
            margin-top: 3rem;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-bottom: 1.5rem;
        }

        .footer-link {
            color: var(--white);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer-link:hover {
            color: var(--aqua-color);
        }

        .copyright {
            opacity: 0.8;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .hero {
                flex-direction: column;
                text-align: center;
            }
            
            .hero-buttons {
                justify-content: center;
            }
            
            .nav-container {
                flex-direction: column;
                gap: 1rem;
                padding: 1rem;
            }
            
            .nav-links {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .hero-buttons {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
    <!-- Ícones do Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <main>
        <section class="hero">
            <div class="hero-content">
                <h1 class="hero-title">Explore o incrível mundo dos peixes carutaperenses</h1>
                <p class="hero-text">Nosso catálogo reúne informações detalhadas sobre diversas espécies aquáticas, suas características, habitats e estados de conservação.</p>
                <div class="hero-buttons">
                    <a href="catalogoPublico.php" class="btn btn-primary">
                        <i class="fas fa-book-open"></i> Ver Catálogo
                    </a>
                    <a href="catalogo.php" class="btn btn-primary" style="background-color: var(--aqua-color);">
                        <i class="fas fa-user"></i> Área do Pesquisador
                    </a>
                </div>
            </div>
            <div class="hero-image">
                <img src="especies/Amure/imagens/Amure.jpg" alt="Peixes coloridos" class="hero-img">
            </div>
        </section>

        <section class="features">
            <h2 class="section-title">Nosso Catálogo Oferece</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3 class="feature-title">Busca Avançada</h3>
                    <p class="feature-text">Encontre espécies por nome, família, habitat ou estado de conservação.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-images"></i>
                    </div>
                    <h3 class="feature-title">Galeria Completa</h3>
                    <p class="feature-text">Fotos detalhadas de cada espécie em seu habitat natural.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <h3 class="feature-title">Informações Detalhadas</h3>
                    <p class="feature-text">Descrição científica, características morfológicas e dados ecológicos.</p>
                </div>
            </div>
        </section>
    </main>
    <footer>
      <div class="footer-links">
        <a href="sobre.php" class="footer-link">Sobre o Projeto</a>
        <!--  
            <a href="contato.php" class="footer-link">Contato</a>
            <a href="termos.php" class="footer-link">Termos de Uso</a>
            <a href="privacidade.php" class="footer-link">Política de Privacidade</a>
            -->
        </div>

        <p class="copyright">© <?php echo date('Y'); ?> PeixeMar - Todos os direitos reservados</p>
    </footer>
</html>