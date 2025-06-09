<?php
$servername = "localhost"; // ou IP do servidor
$username = "root";
$password = "";
$dbname = "carumar";

// Criar conexão
$conexao = new mysqli($servername, $username, $password, $dbname);

// Checar conexão
if ($conexao->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
