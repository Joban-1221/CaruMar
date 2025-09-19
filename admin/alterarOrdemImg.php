<?php
include_once("./config.php");
function consultar($filtro, $parametro)
{
    $sql = "SELECT * FROM imagens WHERE $filtro = ? ORDER BY caminho";
    $prep = $GLOBALS["conexao"]->prepare($sql);
    $prep->bind_param("s", $parametro);
    $prep->execute();
    $prep = $prep->get_result();
    $array = [];
    while($linha = $prep->fetch_assoc()){
        array_push($array, $linha);
    }
    return $array;
}
$sql = "SELECT DISTINCT especie_id FROM imagens ORDER BY especie_id ASC";
$especies_id = $conexao->query($sql);
while($especie_id = $especies_id->fetch_assoc()["especie_id"]){
   print_r(consultar("especie_id", $especie_id));
}
