<?php
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
    $especieTemp["localizacao"] = $linha["localizacao"];
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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-family: Arial, sans-serif;
            font-size: 16px;
            text-align: left;
        }

        th,
        td {
            padding: 12px 15px;
            border: 1px solid #ccc;
        }

        th {
            background-color: #f4f4f4;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .btn-add {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background-color: rgb(0, 206, 93);
            color: white;
            font-size: 1rem;
            font-weight: 600;
            padding: 12px 20px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-decoration: none;
            font-family: Arial, Helvetica, sans-serif;
        }

        .btn-add:hover {
            background-color: rgb(0, 235, 106);
        }

        .btn {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 10px 20px;
            border: 2px solid transparent;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            user-select: none;
            display: inline-block;
            text-align: center;
            text-decoration: none;
            margin: 10px;
            width: 100px;
        }

        /* Visualizar - azul */
        .btn-view {
            background-color: #007BFF;
            color: white;
            border-color: #007BFF;
        }

        .btn-view:hover {
            background-color: transparent;
            color: #007BFF;
        }

        /* Apagar - vermelho */
        .btn-delete {
            background-color: #dc3545;
            color: white;
            border-color: #dc3545;
        }

        .btn-delete:hover {
            background-color: transparent;
            color: #dc3545;
        }

        /* Editar - verde */
        .btn-edit {
            background-color: #28a745;
            color: white;
            border-color: #28a745;
        }

        .btn-edit:hover {
            background-color: transparent;
            color: #28a745;
        }
    </style>

</head>

<body>
    <div>
        <a class="btn-add" href="/catalogação peixes/admin/adicionarEspecies.php">Adicionar Especie</a>
        <table>
            <thead>
                <tr>
                    <th>Nome Popular</th>
                    <th>Nome Cientifico</th>
                    <th>Reino</th>
                    <th>Descrição</th>
                    <th>Família</th>
                    <th>Gênero</th>
                    <th>Local</th>
                    <th>Estado de Conservação</th>
                    <th>Usuario</th>
                    <th>Imgs</th>
                    <th>Ferramentas</th>
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
                    $localizacao = $especie["localizacao"];
                    $estado = $especie["estado"];
                    $usuario = $especie["usuario"];
                    $textImg = "Não há Img";
                    if ($especie["caminhoImg"]) {
                        $arrayImg = $especie["caminhoImg"];
                        $textImg = "";
                        foreach ($arrayImg as $img) {
                            $textImg = $textImg . "<br><img src='$img' style='width:100px;'>";
                        };
                    };

                    $edicao = "<button class='btn btn-view'>Visualizar</button>
                        <button class='btn btn-edit'>Editar</button>
                        <form action='edicao.php' method='POST'>
                            <button type='submit' name='apagar' value='$id' class='btn btn-delete'>Apagar</button>
                        </form>";

                    print("
                     <tr>
                        <td>$nomeP</td>
                        <td>$nomeC</td>
                        <td>$reino</td>
                        <td>$descricao</td>
                        <td>$familia</td>
                        <td>$genero</td>
                        <td>$localizacao</td>
                        <td>$estado</td>
                        <td>$usuario</td>
                        <td>$textImg</td>
                        <td>$edicao</td>
                    </tr>
                    ");
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>