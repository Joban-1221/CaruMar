<?php
include_once("./config.php");
session_start();

// Processar exclusão se solicitado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['excluir_erro'])) {
    $erro_id = intval($_POST['erro_id']);
    
    if ($erro_id > 0) {
        try {
            $stmt = $conexao->prepare("DELETE FROM erros WHERE id = ?");
            $stmt->bind_param("i", $erro_id);
            
            if ($stmt->execute()) {
                $_SESSION['mensagem'] = "Erro excluído com sucesso!";
                $_SESSION['tipo_mensagem'] = "sucesso";
            } else {
                throw new Exception("Erro ao executar a exclusão");
            }
        } catch (Exception $e) {
            $_SESSION['mensagem'] = "Erro ao excluir: " . $e->getMessage();
            $_SESSION['tipo_mensagem'] = "erro";
        }
        
        // Redirecionar para evitar reenvio do formulário
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }
}

// Consulta todos os erros com informações da espécie
$sql = "SELECT er.id AS erro_id, er.mensagem, e.id AS especie_id, e.nomeP AS nomeP, e.nomeC AS nomeC
        FROM erros er
        INNER JOIN especies e ON e.id = er.especie_id
        ORDER BY e.nomeP ASC, er.id DESC";

$result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erros Relatados</title>
    <style>
        :root {
            --primary-color: #4a6fa5;
            --secondary-color: #166088;
            --danger-color: #dc3545;
            --success-color: #28a745;
            --background-color: #f8f9fa;
            --text-color: #333;
            --light-gray: #e9ecef;
            --border-radius: 6px;
            --box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        body {
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
            padding: 2rem;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 2rem;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        h1 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: var(--secondary-color);
            font-weight: 600;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 1.5rem 0;
            font-size: 0.9rem;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }

        th {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .erro-id {
            font-weight: bold;
            color: var(--danger-color);
        }

        .nome-cientifico {
            font-style: italic;
            color: #555;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: var(--border-radius);
            font-size: 0.85rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.25s ease;
            text-decoration: none;
            margin: 0.25rem;
        }

        .btn-detalhes {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-detalhes:hover {
            background-color: var(--secondary-color);
        }

        .btn-excluir {
            background-color: var(--danger-color);
            color: white;
        }

        .btn-excluir:hover {
            background-color: #c82333;
        }

        .btn-group {
            display: flex;
            flex-wrap: wrap;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background-color: white;
            padding: 2rem;
            border-radius: var(--border-radius);
            width: 90%;
            max-width: 400px;
            box-shadow: var(--box-shadow);
        }

        .modal h2 {
            margin-bottom: 1rem;
            color: var(--text-color);
        }

        .modal p {
            margin-bottom: 1.5rem;
            line-height: 1.5;
        }

        .modal-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
        }

        .modal-btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-confirmar {
            background-color: var(--danger-color);
            color: white;
        }

        .btn-confirmar:hover {
            background-color: #c82333;
        }

        .btn-cancelar {
            background-color: var(--light-gray);
            color: var(--text-color);
        }

        .btn-cancelar:hover {
            background-color: #d5d5d5;
        }

        .mensagem {
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: var(--border-radius);
            font-weight: 500;
        }

        .sucesso {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .erro {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .empty-state {
            text-align: center;
            padding: 2rem;
            color: #666;
        }

        .empty-state p {
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }

        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }
            
            .container {
                padding: 1rem;
                overflow-x: auto;
            }
            
            table {
                font-size: 0.8rem;
            }
            
            th, td {
                padding: 8px 10px;
            }
            
            .btn-group {
                flex-direction: column;
            }
            
            .modal-content {
                width: 95%;
                padding: 1.5rem;
            }
            
            .modal-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Erros Relatados</h1>

        <?php
        // Exibir mensagens de feedback
        if (isset($_SESSION['mensagem'])) {
            $classe = $_SESSION['tipo_mensagem'] == 'sucesso' ? 'sucesso' : 'erro';
            echo '<div class="mensagem ' . $classe . '">' . $_SESSION['mensagem'] . '</div>';
            
            // Limpar a mensagem após exibir
            unset($_SESSION['mensagem']);
            unset($_SESSION['tipo_mensagem']);
        }
        ?>

        <?php if ($result && $result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID do Erro</th>
                        <th>Espécie</th>
                        <th>Nome Científico</th>
                        <th>Mensagem</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($erro = $result->fetch_assoc()): ?>
                        <tr>
                            <td class="erro-id">#<?= $erro['erro_id'] ?></td>
                            <td><?= htmlspecialchars($erro['nomeP']) ?> (ID <?= $erro['especie_id'] ?>)</td>
                            <td class="nome-cientifico"><?= htmlspecialchars($erro['nomeC']) ?></td>
                            <td><?= nl2br(htmlspecialchars($erro['mensagem'])) ?></td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-detalhes" href="/visualizarEspecie.php?id=<?= $erro['especie_id'] ?>">Ver Espécie</a>
                                    <button class="btn btn-excluir" onclick="confirmarExclusao(<?= $erro['erro_id'] ?>, '<?= htmlspecialchars(addslashes($erro['nomeP'])) ?>')">Apagar</button>
                                    
                                    <form id="form-excluir-<?= $erro['erro_id'] ?>" method="post" style="display: none;">
                                        <input type="hidden" name="excluir_erro" value="1">
                                        <input type="hidden" name="erro_id" value="<?= $erro['erro_id'] ?>">
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="empty-state">
                <p>Nenhum erro relatado até agora.</p>
            </div>
        <?php endif; ?>

        <!-- Modal de Confirmação -->
        <div id="modalConfirmacao" class="modal">
            <div class="modal-content">
                <h2>Confirmar Exclusão</h2>
                <p>Tem certeza que deseja excluir o erro da espécie: <strong id="nome-especie"></strong>?</p>
                <div class="modal-buttons">
                    <button class="modal-btn btn-cancelar" onclick="fecharModal()">Cancelar</button>
                    <button class="modal-btn btn-confirmar" id="btnConfirmarExclusao">Sim, Excluir</button>
                </div>
            </div>
        </div>

        <script>
            let erroIdParaExcluir;
            
            function confirmarExclusao(id, nomeEspecie) {
                erroIdParaExcluir = id;
                document.getElementById('nome-especie').textContent = nomeEspecie;
                document.getElementById('modalConfirmacao').style.display = 'flex';
            }
            
            function fecharModal() {
                document.getElementById('modalConfirmacao').style.display = 'none';
            }
            
            document.getElementById('btnConfirmarExclusao').addEventListener('click', function() {
                if (erroIdParaExcluir) {
                    document.getElementById('form-excluir-' + erroIdParaExcluir).submit();
                }
            });
            
            // Fechar modal clicando fora dele
            window.addEventListener('click', function(event) {
                const modal = document.getElementById('modalConfirmacao');
                if (event.target === modal) {
                    fecharModal();
                }
            });
        </script>
    </div>
</body>
</html>