<?php
session_start();
if ($_SESSION["usuario_id"] != 1) {
    header("Location: ../catalogo.php");
    exit();
}
if (!empty($_GET["id"])) {

    //CONSULTA ESPECIES
    $id = $_GET["id"];
    include_once("./config.php");
    $sql = "SELECT * FROM especies WHERE id = ?";
    $prep = $conexao->prepare($sql);
    $prep->bind_param("s", $id);
    $prep->execute();
    $especie = $prep->get_result()->fetch_assoc();

    //ATRIBUIÇÃO DE ABREVIATURAS
    $id = $especie["id"];
    $nomeP = $especie["nomeP"];
    $nomeC = $especie["nomeC"];
    $reino = $especie["reino"];
    $descricao = $especie["descricao"];
    $familia = $especie["familia"];
    $genero = $especie["genero"];
    $habitat = $especie["habitat"];
    $estado = $especie["estado"];
    $agua = $especie["agua"];
    $arrayImgs = [];

        //CONSULTA NOME USUARIO POR ID
        $id_usuario = $especie["id_usuario"];
        $sql = "SELECT usuario FROM usuarios WHERE id = ?";
        $prep = $conexao->prepare($sql);
        $prep->bind_param("s", $id_usuario);
        $prep->execute();
        $usuario = $prep->get_result()->fetch_assoc()["usuario"];

        // CONSULTA CAMINHO IMAGENS POR ID
        $sql = "SELECT caminho FROM imagens WHERE especie_id = ?";
        $prep = $conexao->prepare($sql);
        $prep->bind_param("s", $id);
        $prep->execute();
        $arrayImgsTemp = $prep->get_result();
        if ($arrayImgsTemp->num_rows > 0) {
        while ($linhaImg = $arrayImgsTemp->fetch_assoc()) {
            foreach ($linhaImg as $caminho) {
                array_push($arrayImgs, $caminho);
            }
        }
        
        //EXIBIR IMGS
        $imagensHTML = "<div class='img-container'>Nenhuma imagem</div>";
        if (!empty($arrayImgs)) {
            $imagensHTML = "<div class='img-container'>";
            foreach ($arrayImgs as $img) {
                $imagensHTML .= "<img src='/carumar/$img' class='thumbnail' alt='Imagem da espécie'>";
            }
            $imagensHTML .= "</div>";
        }
    }

} else {
    header("Location: ../catalogo.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatar Erro - <?php echo htmlspecialchars($nomeP); ?></title>
    <style>
        :root {
            --primary-color: #4a6fa5;
            --secondary-color: #166088;
            --danger-color: #e4de2dff;
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
            color: var(--danger-color);
            margin-bottom: 1.5rem;
            text-align: center;
            font-weight: 600;
        }

        h2 {
            color: var(--secondary-color);
            margin: 1.5rem 0 1rem;
            font-weight: 500;
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

        .img-container {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .thumbnail {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 4px;
            margin: 2px;
            border: 1px solid #ddd;
            transition: transform 0.2s ease;
        }

        .thumbnail:hover {
            transform: scale(1.5);
            z-index: 10;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .error-form {
            margin-top: 2rem;
            padding: 1.5rem;
            background-color: #fff8f8;
            border-left: 4px solid var(--danger-color);
            border-radius: var(--border-radius);
        }

        textarea {
            width: 100%;
            padding: 1rem;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: 1rem;
            min-height: 150px;
            margin-bottom: 1rem;
            transition: border 0.3s ease;
        }

        textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(74, 111, 165, 0.2);
        }

        .btn {
            display: inline-block;
            background-color: var(--danger-color);
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: var(--border-radius);
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-weight: 500;
        }

        .btn:hover {
            background-color: #b8b43cff;
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
            
            .img-container {
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Relatar Erro na Catalogação</h1>
        
        <h2>Espécie: <?php echo htmlspecialchars($nomeP); ?></h2>
        
        <table>
            <thead>
                <tr>
                    <th>Nome Popular</th>
                    <th>Nome Científico</th>
                    <th>Reino</th>
                    <th>Descrição</th>
                    <th>Família</th>
                    <th>Gênero</th>
                    <th>Habitat</th>
                    <th>Estado</th>
                    <th>Água</th>
                    <th>Usuário</th>
                    <th>Imagens</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo htmlspecialchars($nomeP); ?></td>
                    <td><?php echo htmlspecialchars($nomeC); ?></td>
                    <td><?php echo htmlspecialchars($reino); ?></td>
                    <td><?php echo htmlspecialchars(substr($descricao, 0, 50)) . '...'; ?></td>
                    <td><?php echo htmlspecialchars($familia); ?></td>
                    <td><?php echo htmlspecialchars($genero); ?></td>
                    <td><?php echo htmlspecialchars($habitat); ?></td>
                    <td><?php echo htmlspecialchars($estado); ?></td>
                    <td><?php echo htmlspecialchars($agua); ?></td>
                    <td><?php echo htmlspecialchars($usuario); ?></td>
                    <td><?php echo $imagensHTML; ?></td>
                </tr>
            </tbody>
        </table>

        <div class="error-form">
            <h2>Discorra sobre o erro encontrado</h2>
            <form action="processarErro.php" method="post">
                <input type="hidden" name="especie_id" value="<?php echo $id; ?>">
                <textarea name="mensagem" id="mensagem" placeholder="Descreva detalhadamente o erro encontrado na catalogação desta espécie..." required></textarea>
                <button type="submit" class="btn">Enviar Relato</button>
            </form>
        </div>
    </div>
</body>

</html>