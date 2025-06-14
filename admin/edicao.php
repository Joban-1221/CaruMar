<?php
session_start();
if($_SESSION["usuario_id"] != 1){
    header("Location: ../catalogo.php");
    exit();
}
if (!empty($_GET["id"])) {
    include_once("config.php");
    $id = (int)$_GET["id"]; // cast para int para maior segurança
    $dadosEspecies = $conexao->query("SELECT * FROM especies WHERE id=$id");

    $especie = [];

    foreach ($dadosEspecies as $linha) {
        $arrayDados = [];

        $arrayDados['id'] = $linha['id'];
        $arrayDados['nomeP'] = $linha['nomeP'];
        $arrayDados['nomeC'] = $linha['nomeC'];
        $arrayDados['reino'] = $linha['reino'];
        $arrayDados['descricao'] = $linha['descricao'];
        $arrayDados['familia'] = $linha['familia'];
        $arrayDados['genero'] = $linha['genero'];
        $arrayDados['estado'] = $linha['estado'];
        $arrayDados['modeloOld'] = $linha['modeloOld'];
        $arrayDados['habitat'] = $linha['habitat'];
        $arrayDados['id_usuario'] = $linha['id_usuario'];

        $especie[] = $arrayDados;
    }

    if (count($especie) === 0) {
        // Se não encontrou a espécie, redireciona
        header("Location: ../catalogo.php");
        exit();
    }

} else {
    header("Location: ../catalogo.php");
    exit();
}

// Pegando o registro único para facilitar
$esp = $especie[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Espécie</title>
    <style>
        :root {
            --primary-color: #4a6fa5;
            --secondary-color: #166088;
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

        form {
            max-width: 800px;
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

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--secondary-color);
            font-size: 0.9rem;
        }

        input[type="text"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: border 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(74, 111, 165, 0.2);
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        button[type="submit"] {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: var(--border-radius);
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: block;
            margin: 2rem auto 0;
            width: 200px;
            font-weight: 500;
        }

        button[type="submit"]:hover {
            background-color: var(--secondary-color);
        }

        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }
            
            form {
                padding: 1.5rem;
            }
            
            .form-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <form action="atualizarEspecie.php" method="post">
        <h1>Atualizar Espécie</h1>
        
        <div class="form-grid">
            <input type="hidden" name="id" value="<?= htmlspecialchars($esp['id']) ?>">

            <div class="form-group">
                <label for="nomeP">Nome Popular</label>
                <input type="text" id="nomeP" name="nomeP" value="<?= htmlspecialchars($esp['nomeP']) ?>" required>
            </div>

            <div class="form-group">
                <label for="nomeC">Nome Científico</label>
                <input type="text" id="nomeC" name="nomeC" value="<?= htmlspecialchars($esp['nomeC']) ?>" required>
            </div>

            <div class="form-group">
                <label for="reino">Reino</label>
                <select id="reino" name="reino" required>
                    <?php
                    $reinos = ['Animalia','Plantae','Fungi','Protista','Monera'];
                    foreach ($reinos as $reino) {
                        $selected = ($esp['reino'] === $reino) ? "selected" : "";
                        echo "<option value=\"$reino\" $selected>$reino</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="descricao">Descrição</label>
                <textarea id="descricao" name="descricao" rows="4"><?= htmlspecialchars($esp['descricao']) ?></textarea>
            </div>

            <div class="form-group">
                <label for="familia">Família</label>
                <input type="text" id="familia" name="familia" value="<?= htmlspecialchars($esp['familia']) ?>">
            </div>

            <div class="form-group">
                <label for="genero">Gênero</label>
                <input type="text" id="genero" name="genero" value="<?= htmlspecialchars($esp['genero']) ?>">
            </div>

            <div class="form-group">
                <label for="estado">Estado</label>
                <input type="text" id="estado" name="estado" value="<?= htmlspecialchars($esp['estado']) ?>">
            </div>

            <div class="form-group">
                <label for="modeloOld">Modelo Old</label>
                <input type="text" id="modeloOld" name="modeloOld" value="<?= htmlspecialchars($esp['modeloOld']) ?>">
            </div>

            <div class="form-group">
                    <label for="agua">Tipo de Água</label>
                    <select id="agua" name="agua" required>
                        <option value="">Selecione...</option>
                        <option value="Doce">Água Doce</option>
                        <option value="Salgada">Água Salgada</option>
                        <option value="Ambos">Ambos Tipos</option>
                    </select>
                </div>

            <div class="form-group">
                <label for="habitat">Habitat</label>
                <input type="text" id="habitat" name="habitat" value="<?= htmlspecialchars($esp['habitat']) ?>">
            </div>

            <div class="form-group">
                <div class="form-group">
                    <label for="usuario">Usuário</label>
                    <select id="usuario" name="usuario">
                        <option value="">Selecione...</option>
                        <option value="1">Jovan</option>
                        <option value="2">Klyssia</option>
                        <option value="3">Geise</option>
                        <option value="4">Kerllon</option>
                        <option value="5">Jamilly</option>
                        <option value="6">Nathally</option>
                        <option value="7">Adriele</option>
                        <option value="8">Fabrícia</option>
                        <option value="9">Rayane</option>
                        <option value="10">Maria Clara</option>
                    </select>
                </div>
            </div>
        </div>

        <button type="submit">Atualizar</button>
    </form>
</body>
</html>