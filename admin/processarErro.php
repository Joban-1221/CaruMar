<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once("config.php");

    print_r($_POST);
    $mensagem = $_POST["mensagem"];
    $especie_id = $_POST["especie_id"];


    $sql = "INSERT INTO erros(especie_id, mensagem) VALUES(?, ?)";
    $prep = $conexao->prepare($sql);
    $prep->bind_param("ss", $especie_id, $mensagem);
    $prep->execute();
    print_r($prep->get_result());

    header("Location: ../catalogo.php");
    exit();
}
else{
    header("Location: ../catalogo.php");
    exit();
}


?>