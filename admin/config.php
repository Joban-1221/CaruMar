<?php
$servername = "localhost"; // ou IP do servidor
$username = "carumar";
$password = "Carumar/213";
$dbname = "carumar";

// Criar conexão
$conexao = new mysqli($servername, $username, $password, $dbname);
$conexao->set_charset("utf8");

// Checar conexão
if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}
?>
