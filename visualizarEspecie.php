<?php
session_start();
include_once("admin/config.php");

// Verifica se o ID da espécie foi passado
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: catalogo.php");
    exit();
}

$id_especie = intval($_GET['id']);

// Consulta os dados da espécie
$query_especie = $conexao->prepare("SELECT e.*, u.usuario 
                                   FROM especies e 
                                   LEFT JOIN usuarios u ON e.id_usuario = u.id 
                                   WHERE e.id = ?");
$query_especie->bind_param("i", $id_especie);
$query_especie->execute();
$result_especie = $query_especie->get_result();

if ($result_especie->num_rows === 0) {
    header("Location: catalogo.php");
    exit();
}

$especie = $result_especie->fetch_assoc();

// Consulta as imagens da espécie
$query_imagens = $conexao->prepare("SELECT caminho FROM imagens WHERE especie_id = ?");
$query_imagens->bind_param("i", $id_especie);
$query_imagens->execute();
$result_imagens = $query_imagens->get_result();

$imagens = [];
while ($linha = $result_imagens->fetch_assoc()) {
    $imagens[] = $linha['caminho'];
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($especie['nomeP']) ?> - Detalhes</title>
    <style>
        :root {
            --primary-color: #4a6fa5;
            --secondary-color: #166088;
            --light-gray: #f8f9fa;
            --dark-gray: #343a40;
            --border-radius: 8px;
            --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        body {
            background-color: var(--light-gray);
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #eee;
        }

        .title {
            color: var(--secondary-color);
            font-size: 2rem;
            font-weight: 600;
        }

        .subtitle {
            color: var(--primary-color);
            font-style: italic;
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }

        .btn {
            display: inline-block;
            padding: 0.6rem 1.2rem;
            background-color: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: var(--border-radius);
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .btn:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }

        .btn-back {
            background-color: #6c757d;
        }

        .btn-back:hover {
            background-color: #5a6268;
        }

        .main-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .image-section {
            display: flex;
            flex-direction: column;
        }

        .info-section {
            margin-bottom: 1.5rem;
        }

        .info-title {
            font-weight: 600;
            color: var(--dark-gray);
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }

        .info-content {
            background-color: var(--light-gray);
            padding: 1rem;
            border-radius: var(--border-radius);
        }

        .main-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: var(--border-radius);
            margin-bottom: 1rem;
            box-shadow: var(--box-shadow);
        }

        .thumbnail-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            gap: 1rem;
        }

        .thumbnail {
            width: 100%;
            height: 100px;
            object-fit: cover;
            border-radius: 4px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .thumbnail:hover {
            transform: scale(1.05);
        }

        .taxonomy {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
        }

        .details-section {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .additional-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }

        @media (max-width: 768px) {
            .main-content {
                grid-template-columns: 1fr;
            }
            
            .container {
                padding: 1rem;
                margin: 1rem;
            }
            
            .title {
                font-size: 1.5rem;
            }
            
            .subtitle {
                font-size: 1rem;
            }
            
            .additional-info {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div>
                <h1 class="title"><?= htmlspecialchars($especie['nomeP']) ?></h1>
                <h2 class="subtitle"><?= htmlspecialchars($especie['nomeC']) ?></h2>
            </div>
            <a href="<?php echo !empty($_SESSION['usuario_id']) ? 'catalogo.php' : 'catalogoPublico.php'; ?>" class="btn btn-back">Voltar ao Catálogo</a>
        </div>

        <div class="main-content">
            <div class="image-section">
                <?php if (!empty($imagens)): ?>
                    <img id="main-image" src="<?= htmlspecialchars($imagens[0]) ?>" class="main-image" alt="Imagem principal da espécie">
                    
                    <div class="thumbnail-container">
                        <?php foreach ($imagens as $index => $img): ?>
                            <img src="<?= htmlspecialchars($img) ?>" 
                                 class="thumbnail" 
                                 alt="Imagem da espécie"
                                 onclick="document.getElementById('main-image').src = '<?= htmlspecialchars($img) ?>'">
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="info-content">
                        <p>Nenhuma imagem disponível para esta espécie.</p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="details-section">
                <div>
                    <div class="info-section">
                        <h3 class="info-title">Descrição</h3>
                        <div class="info-content">
                            <p><?= nl2br(htmlspecialchars($especie['descricao'])) ?></p>
                        </div>
                    </div>

                    <div class="info-section">
                        <h3 class="info-title">Classificação Taxonômica</h3>
                        <div class="info-content taxonomy">
                            <div>
                                <strong>Reino:</strong>
                                <p><?= htmlspecialchars($especie['reino']) ?></p>
                            </div>
                            <div>
                                <strong>Família:</strong>
                                <p><?= htmlspecialchars($especie['familia']) ?></p>
                            </div>
                            <div>
                                <strong>Gênero:</strong>
                                <p><?= htmlspecialchars($especie['genero']) ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="info-section">
                    <h3 class="info-title">Cadastrado por</h3>
                    <div class="info-content">
                        <p><?= htmlspecialchars($especie['usuario']) ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="additional-info">
            <div>
                <div class="info-section">
                    <h3 class="info-title">Habitat</h3>
                    <div class="info-content">
                        <p><?= htmlspecialchars($especie['habitat']) ?></p>
                    </div>
                </div>
            </div>
            
            <div>
                <div class="info-section">
                    <h3 class="info-title">Estado de Conservação</h3>
                    <div class="info-content">
                        <p><?= htmlspecialchars($especie['estado']) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Função para trocar a imagem principal ao clicar nas miniaturas
        document.querySelectorAll('.thumbnail').forEach(thumb => {
            thumb.addEventListener('click', function() {
                document.getElementById('main-image').src = this.src;
            });
        });
    </script>
</body>
</html>