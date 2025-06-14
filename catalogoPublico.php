<?php
include_once("admin/config.php");


// Consulta as espécies com informações básicas
$query = $conexao->query("
    SELECT e.id, e.nomeP, e.nomeC, e.descricao, i.caminho as imagem
    FROM especies e
    LEFT JOIN (
        SELECT especie_id, MIN(caminho) as caminho 
        FROM imagens 
        GROUP BY especie_id
    ) i ON e.id = i.especie_id
    ORDER BY e.nomeP
");

$especies = [];
while ($linha = $query->fetch_assoc()) {
    $especies[] = $linha;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Espécies Aquáticas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #3498db;
            --accent: #e74c3c;
            --light: #ecf0f1;
            --dark: #2c3e50;
            --text: #333;
            --text-light: #7f8c8d;
            --card-shadow: 0 10px 20px rgba(0,0,0,0.1);
            --hover-shadow: 0 15px 30px rgba(0,0,0,0.2);
            --transition: all 0.3s ease;
            --border-radius: 12px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f7fa;
            color: var(--text);
            line-height: 1.6;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }

        header {
            text-align: center;
            margin-bottom: 3rem;
            position: relative;
        }

        .header-content {
            max-width: 800px;
            margin: 0 auto;
        }

        h1 {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .subtitle {
            font-size: 1.1rem;
            color: var(--text-light);
            margin-bottom: 2rem;
        }

        .search-container {
            display: flex;
            max-width: 600px;
            margin: 0 auto 2rem;
            position: relative;
        }

        .search-input {
            flex: 1;
            padding: 1rem 1.5rem;
            border: 2px solid #ddd;
            border-radius: 50px;
            font-size: 1rem;
            transition: var(--transition);
            padding-left: 3rem;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--secondary);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }

        .search-icon {
            position: absolute;
            left: 1.5rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
        }

        .filter-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .filter-btn {
            padding: 0.6rem 1.2rem;
            background: white;
            border: 1px solid #ddd;
            border-radius: 50px;
            cursor: pointer;
            transition: var(--transition);
            font-size: 0.9rem;
        }

        .filter-btn:hover, .filter-btn.active {
            background: var(--secondary);
            color: white;
            border-color: var(--secondary);
        }

        .species-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
        }

        .species-card {
            background: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            position: relative;
        }

        .species-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--hover-shadow);
        }

        .card-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-bottom: 1px solid #eee;
        }

        .no-image {
            width: 100%;
            height: 200px;
            background: var(--light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-light);
        }

        .card-content {
            padding: 1.5rem;
        }

        .card-title {
            font-size: 1.3rem;
            color: var(--primary);
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .card-scientific {
            font-style: italic;
            color: var(--text-light);
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .card-desc {
            color: var(--text);
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .card-link {
            display: inline-block;
            padding: 0.6rem 1.2rem;
            background: var(--secondary);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-size: 0.9rem;
            transition: var(--transition);
            text-align: center;
        }

        .card-link:hover {
            background: var(--primary);
        }

        .view-more {
            text-align: center;
            margin-top: 3rem;
        }

        .view-more-btn {
            padding: 0.8rem 2rem;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: var(--transition);
            font-size: 1rem;
        }

        .view-more-btn:hover {
            background: var(--secondary);
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }
            
            h1 {
                font-size: 2rem;
            }
            
            .species-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div class="header-content">
                <h1>Catálogo de Espécies Aquáticas</h1>
                <p class="subtitle">Explore nossa coleção de espécies marinhas e de água doce</p>
                
                <div class="search-container">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="search-input" placeholder="Buscar espécies...">
                </div>
                
            </div>
        </header>
        
        <main>
            <div class="species-grid">
                <?php foreach ($especies as $especie): ?>
                    <div class="species-card">
                        <?php if (!empty($especie['imagem'])): ?>
                            <img src="<?= htmlspecialchars($especie['imagem']) ?>" alt="<?= htmlspecialchars($especie['nomeP']) ?>" class="card-image">
                        <?php else: ?>
                            <div class="no-image">
                                <i class="fas fa-fish" style="font-size: 2rem;"></i>
                            </div>
                        <?php endif; ?>
                        
                        <div class="card-content">
                            <h2 class="card-title"><?= htmlspecialchars($especie['nomeP']) ?></h2>
                            <p class="card-scientific"><?= htmlspecialchars($especie['nomeC']) ?></p>
                            <p class="card-desc"><?= htmlspecialchars(substr($especie['descricao'], 0, 150)) ?>...</p>
                            <a href="visualizarEspecie.php?id=<?= $especie['id'] ?>" class="card-link">Ver Detalhes</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="view-more">
                <button class="view-more-btn">Carregar Mais Espécies</button>
            </div>
        </main>
    </div>

    <script>
        // Filtros e busca (funcionalidade básica)
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelector('.filter-btn.active').classList.remove('active');
                this.classList.add('active');
                // Aqui iria a lógica para filtrar as espécies
            });
        });

        // Busca por texto
        const searchInput = document.querySelector('.search-input');
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const cards = document.querySelectorAll('.species-card');
            
            cards.forEach(card => {
                const title = card.querySelector('.card-title').textContent.toLowerCase();
                const scientific = card.querySelector('.card-scientific').textContent.toLowerCase();
                
                if (title.includes(searchTerm) || scientific.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>