<?php
include_once("admin/verificarAdmin.php");
include_once("admin/config.php");
$especiesTemp = $conexao->query("SELECT * FROM especies");
$especies = [];
while ($linha = $especiesTemp->fetch_assoc()) {
    $especieTemp = [];
    $especieTemp["id"] = $linha["id"];
    $especieTemp["nomeP"] = $linha["nomeP"];
    $especieTemp["nomeC"] = $linha["nomeC"];
    $especieTemp["reino"] = $linha["reino"];
    $especieTemp["descricao"] = $linha["descricao"];
    $especieTemp["familia"] = $linha["familia"];
    $especieTemp["genero"] = $linha["genero"];
    $especieTemp["estado"] = $linha["estado"];
    $especieTemp["habitat"] = $linha["habitat"];
    $especieTemp["agua"] = $linha["agua"];
    $especieTemp["caminhoImg"] = [];

    //Referencia o id com o usuario
    $id_usuarioArray =  $linha["id_usuario"];
    $id_usuarioArray = $conexao->query("SELECT usuario FROM usuarios WHERE id = $id_usuarioArray");
    foreach ($id_usuarioArray as $usuario) {
        $especieTemp["usuario"] = $usuario["usuario"];
    }

    //Criar o Array com o caminho da img
    $id_especie = $linha["id"];
    $arrayImgs = $conexao->query("SELECT caminho FROM imagens WHERE especie_id = $id_especie");
    if ($arrayImgs->num_rows > 0) {
        while ($linhaImg = $arrayImgs->fetch_assoc()) {
            foreach ($linhaImg as $caminho) {
                array_push($especieTemp["caminhoImg"], $caminho);
            }
        }
    }
    array_push($especies, $especieTemp);
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Espécies</title>
    <style>
        :root {
            --primary-color: #4a6fa5;
            --secondary-color: #166088;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --info-color: #17a2b8;
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
            padding: 1rem;
        }

        .container {
            max-width: 100%;
            margin: 0 auto;
            background: white;
            padding: 1rem;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow-x: auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: var(--secondary-color);
            font-weight: 600;
            font-size: 1.5rem;
        }

        .header-wrapper {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .header-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            justify-content: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 1.5rem 0;
            font-size: 0.9rem;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
            min-width: 800px;
        }

        th, td {
            padding: 10px 8px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
            font-size: 0.85rem;
        }

        th {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.3rem;
            padding: 0.5rem 0.8rem;
            border: none;
            border-radius: var(--border-radius);
            font-size: 0.8rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.25s ease;
            text-decoration: none;
            margin: 0.15rem;
        }

        .btn-add {
            background-color: var(--success-color);
            color: white;
            padding: 0.6rem 1rem;
            font-weight: 600;
        }

        .btn-voltar {
            background-color: var(--info-color);
            color: white;
            padding: 0.6rem 1rem;
            font-weight: 600;
        }
        
        .btn-voltar:hover {
            background-color: rgb(33, 95, 136);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-add:hover {
            background-color: #218838;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-view {
            background-color: var(--info-color);
            color: white;
        }

        .btn-view:hover {
            background-color: #138496;
        }

        .btn-edit {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-edit:hover {
            background-color: var(--secondary-color);
        }

        .btn-delete {
            background-color: var(--danger-color);
            color: white;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        .btn-group {
            display: flex;
            flex-wrap: wrap;
            gap: 0.3rem;
        }

        .thumbnail {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 4px;
            margin: 2px;
            border: 1px solid #ddd;
        }

        .thumbnail:hover {
            transform: scale(1.5);
            z-index: 10;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s ease;
        }

        .img-container {
            display: flex;
            flex-wrap: wrap;
            gap: 0.3rem;
        }
            .header-wrapper {
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
            }
            
            .header-actions {
                justify-content: flex-end;
            }
            
            table {
                font-size: 0.9rem;
                min-width: auto;
            }
            
            th, td {
                padding: 12px 15px;
                font-size: 0.85rem;
            }
            
            .btn {
                padding: 0.5rem 1rem;
                font-size: 0.85rem;
            }
            
            .thumbnail {
                width: 60px;
                height: 60px;
            }
    </style>
</head>

<body>
    <div class="container">
        <div class="header-wrapper">
            <h1>Catálogo de Espécies</h1>
            <div class="header-actions">
                <a class="btn btn-voltar" href="catalogoPublico.php">
                    <span><=</span> Público
                </a>
                <a class="btn btn-add" href="admin/adicionarEspecies.php">
                    <span>+</span> Adicionar
                </a>
            </div>
        </div>

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
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($especies as $especie) {
                    $id = $especie["id"];
                    $nomeP = $especie["nomeP"];
                    $nomeC = $especie["nomeC"];
                    $reino = $especie["reino"];
                    $descricao = $especie["descricao"];
                    $familia = $especie["familia"];
                    $genero = $especie["genero"];
                    $habitat = $especie["habitat"];
                    $estado = $especie["estado"];
                    $usuario = $especie["usuario"];
                    $agua = $especie["agua"];

                    // Tratamento das imagens
                    $imagensHTML = "<div class='img-container'>Nenhuma imagem</div>";
                    if (!empty($especie["caminhoImg"])) {
                        $imagensHTML = "<div class='img-container'>";
                        foreach ($especie["caminhoImg"] as $img) {
                            $imagensHTML .= "<img src='$img' class='thumbnail' alt='Imagem da espécie'>";
                        }
                        $imagensHTML .= "</div>";
                    }

                    // Botões de ação
                    if($_SESSION["usuario_id"] == 1){
                    $acoesHTML = "
                        <div class='btn-group'>
                            <a href='visualizarEspecie.php?id=$id' class='btn btn-view'>Ver</a>
                            <a href='admin/edicao.php?id=$id' class='btn btn-edit'>Editar</a>
                            <form action='admin/apagar.php' method='POST' style='display:inline;'>
                                <button type='submit' name='apagar' value='$id' class='btn btn-delete'>Apagar</button>
                            </form>
                        </div>
                    ";
                    }else{
                        $acoesHTML = "
                        <div class='btn-group'>
                            <a href='visualizarEspecie.php?id=$id' class='btn btn-view'>Ver</a>
                        </div>
                    ";
                    }

                    echo "
                    <tr>
                        <td>$nomeP</td>
                        <td>$nomeC</td>
                        <td>$reino</td>
                        <td>" . substr($descricao, 0, 50) . "...</td>
                        <td>$familia</td>
                        <td>$genero</td>
                        <td>$habitat</td>
                        <td>$estado</td>
                        <td>$agua</td>
                        <td>$usuario</td>
                        <td>$imagensHTML</td>
                        <td>$acoesHTML</td>
                    </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>