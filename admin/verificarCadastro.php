<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once("config.php");

    $usuario = $_POST["usuario"];
    $cpf = $_POST["cpf"];
    $senha = $_POST["senha"];
    $is_admin = $_POST["is_admin"];

    $senha = password_hash($senha, PASSWORD_DEFAULT);

    $conexao -> query("INSERT INTO usuarios(usuario, cpf, senha, is_admin) VALUES('$usuario', '$cpf', '$senha', '$is_admin')");
    header("Location: ../login.php");
} else {
    header("Location: ../login.php");
    exit();
}
?>