<?php
if (!empty($_GET["id"])) {
    include_once("admin/config.php");
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
        $arrayDados['localizacao'] = $linha['localizacao'];
        $arrayDados['id_usuario'] = $linha['id_usuario'];

        $especie[] = $arrayDados;
    }

    if (count($especie) === 0) {
        // Se não encontrou a espécie, redireciona
        header("Location: catalogo.php");
        exit();
    }

} else {
    header("Location: catalogo.php");
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
    <title>Document</title>
</head>
<body>
    <form action="atualizar_especie.php" method="post">
    <input type="hidden" name="id" value="<?= htmlspecialchars($esp['id']) ?>">

    <label for="nomeP">Nome Popular:</label>
    <input type="text" id="nomeP" name="nomeP" value="<?= htmlspecialchars($esp['nomeP']) ?>" required>

    <label for="nomeC">Nome Científico:</label>
    <input type="text" id="nomeC" name="nomeC" value="<?= htmlspecialchars($esp['nomeC']) ?>" required>

    <label for="reino">Reino:</label>
    <select id="reino" name="reino" required>
        <?php
        $reinos = ['Animalia','Plantae','Fungi','Protista','Monera'];
        foreach ($reinos as $reino) {
            $selected = ($esp['reino'] === $reino) ? "selected" : "";
            echo "<option value=\"$reino\" $selected>$reino</option>";
        }
        ?>
    </select>

    <label for="descricao">Descrição:</label>
    <textarea id="descricao" name="descricao" rows="4"><?= htmlspecialchars($esp['descricao']) ?></textarea>

    <label for="familia">Família:</label>
    <input type="text" id="familia" name="familia" value="<?= htmlspecialchars($esp['familia']) ?>">

    <label for="genero">Gênero:</label>
    <input type="text" id="genero" name="genero" value="<?= htmlspecialchars($esp['genero']) ?>">

    <label for="estado">Estado:</label>
    <input type="text" id="estado" name="estado" value="<?= htmlspecialchars($esp['estado']) ?>">

    <label for="modeloOld">Modelo Old:</label>
    <input type="text" id="modeloOld" name="modeloOld" value="<?= htmlspecialchars($esp['modeloOld']) ?>">

    <label for="localizacao">Localização:</label>
    <input type="text" id="localizacao" name="localizacao" value="<?= htmlspecialchars($esp['localizacao']) ?>">

    <label for="id_usuario">Usuário ID:</label>
    <input type="number" id="id_usuario" name="id_usuario" value="<?= htmlspecialchars($esp['id_usuario']) ?>" readonly>

    <button type="submit">Atualizar</button>
</form>
</body>
</html>
