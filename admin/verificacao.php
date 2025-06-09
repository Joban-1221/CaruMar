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
    $usuario = $_POST["usuario"];
    $agua = $_POST["agua"];

    $sql = "INSERT INTO especies(nomeP, nomeC, reino, descricao, familia, genero, estado, modeloOld, habitat, agua, id_usuario) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sssssssssss", $nomeP, $nomeC, $reino, $descricao, $familia, $genero, $estado, $modeloOld, $habitat, $agua, $usuario);
    $stmt->execute();

    $especie_id = $stmt->insert_id;

    $pastaRelativa = "especies/$modeloOld/imagens";
    $dir = __DIR__ . "/../especies/$modeloOld/imagens";


    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }

    if (isset($_FILES['imagens'])) {
        $numImgs = count($_FILES['imagens']['name']);
        for ($i = 0; $i < $numImgs; $i++) {
            if ($_FILES['imagens']['error'][$i] === UPLOAD_ERR_OK) {
                $imgArray = $_FILES['imagens'];
                $nomeTemp = $imgArray['tmp_name'][$i];
                $nomeOriginal = basename($imgArray['name'][$i]);
                $extensao = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));
                $nomeFinal = $i + 1 . "." . $extensao;
                $caminhoFinal = $dir . "/" . $nomeFinal;
                $pastaUpload = $pastaRelativa . "/" . $nomeFinal;

                // Carrega a imagem conforme o tipo
                switch ($extensao) {
                    case 'jpg':
                    case 'jpeg':
                        $origem = imagecreatefromjpeg($nomeTemp);
                        break;
                    case 'png':
                        $origem = imagecreatefrompng($nomeTemp);
                        break;
                    case 'gif':
                        $origem = imagecreatefromgif($nomeTemp);
                        break;
                    case 'webp':
                        if (function_exists('imagecreatefromwebp')) {
                            $origem = imagecreatefromwebp($nomeTemp);
                        } else {
                            continue 2; // Pula imagem se não suportar webp
                        }
                        break;
                    default:
                        continue 2; // Tipo não suportado
                }

                if (!$origem) continue;

                $largura = imagesx($origem);
                $altura = imagesy($origem);
                $ladoFinal = max($largura, $altura);
                $imgFinal = imagecreatetruecolor($ladoFinal, $ladoFinal);

                $preto = imagecolorallocate($imgFinal, 0, 0, 0);
                imagefill($imgFinal, 0, 0, $preto);

                $x = ($ladoFinal - $largura) / 2;
                $y = ($ladoFinal - $altura) / 2;

                imagecopy($imgFinal, $origem, $x, $y, 0, 0, $largura, $altura);

                // Salva a imagem final conforme tipo
                switch ($extensao) {
                    case 'jpg':
                    case 'jpeg':
                        imagejpeg($imgFinal, $caminhoFinal, 90);
                        break;
                    case 'png':
                        imagepng($imgFinal, $caminhoFinal);
                        break;
                    case 'gif':
                        imagegif($imgFinal, $caminhoFinal);
                        break;
                    case 'webp':
                        if (function_exists('imagewebp')) {
                            imagewebp($imgFinal, $caminhoFinal, 90);
                        }
                        break;
                }

                imagedestroy($origem);
                imagedestroy($imgFinal);

                $sqlImg = "INSERT INTO imagens (especie_id, caminho) VALUES (?, ?)";
                $stmtImg = $conexao->prepare($sqlImg);
                $stmtImg->bind_param("is", $especie_id, $pastaUpload);
                $stmtImg->execute();
            }
        }
    }

    header("Location: ../catalogo.php");
} else {
    header("Location: ../catalogo.php");
    exit();
}
