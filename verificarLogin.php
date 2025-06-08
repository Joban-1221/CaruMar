<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once("admin/config.php");
    $cpf = $_POST["cpf"];
    $senha = $_POST["senha"];

    $result = $conexao->query("SELECT * FROM usuarios WHERE cpf = $cpf");
    if (mysqli_num_rows($result) > 0) {
        foreach ($result as $linha) {
            if($cpf == $linha["cpf"] AND password_verify($senha, $linha["senha"])){
                session_start();
                $_SESSION["usuario_id"] = $linha["id"];
                $_SESSION["usuario"] = $linha["usuario"];
                $_SESSION["is_admin"] = $linha["is_admin"];
                header("Location: catalogo.php");
            }else{
                header("Location: login.php?msg=SenhaIncorreta");
            }
        }
    } else {
        header("Location: login.php?msg=cpfInvalido");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
?>