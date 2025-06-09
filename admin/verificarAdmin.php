<?php
session_start();

// Verifica se o usuário está logado
if (empty($_SESSION['usuario'])) {
    header('Location: ../login.php');
    exit();
}

// Verifica se o usuário é admin
if (empty($_SESSION['is_admin'])) {
    header('Location: ../catalogoPublico.php');
    exit();
}
?>
