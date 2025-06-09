<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once("config.php");

    $nomeP = $_POST["nomeP"];
    $nomeC = $_POST["nomeC"];
    $reino = $_POST["reino"];
    $descricao = $_POST["descricao"];
    $familia = $_POST["familia"];
    $genero = $_POST["genero"];
    $habitat = $_POST["habitat"];
    $estado = $_POST["estado"];
    $modeloOld = $_POST["modeloOld"];
    $id_usuario = $_POST["usuario"];
    $agua = $_POST["agua"];
    $id = $_POST["id"];

    $sql = "UPDATE especies SET nomeP=?, nomeC=?, reino=?, descricao=?, familia=?, genero=?, estado=?, modeloOld=?, habitat=?, id_usuario=?, agua=? WHERE id=?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssssssssssss", $nomeP, $nomeC, $reino, $descricao, $familia, $genero, $estado, $modeloOld, $habitat, $id_usuario, $agua, $id);
    $stmt->execute();

    header("Location: ../catalogo.php");
}
else{
    header("Location: ../catalogo.php");
    exit();
}
    ?>