<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    function apagarPasta($caminho)
    {
        if (!is_dir($caminho)) return false;

        $itens = array_diff(scandir($caminho), ['.', '..']);
        foreach ($itens as $item) {
            $itemPath = $caminho . DIRECTORY_SEPARATOR . $item;
            if (is_dir($itemPath)) {
                apagarPasta($itemPath);
            } else {
                unlink($itemPath);
            }
        }

        return rmdir($caminho);
    }

    // Conexão com o banco
    include_once("admin/config.php");

    // ID da espécie (pode vir por POST, exemplo)
    $id = $_POST["apagar"];

    // Pega uma imagem para descobrir a pasta da espécie
    $result = $conexao->query("SELECT caminho FROM imagens WHERE especie_id = $id LIMIT 1");

    if ($result && $linha = $result->fetch_assoc()) {
        $caminhoRelativoImagem = $linha['caminho'];

        // Caminho absoluto até a imagem
        $caminhoAbsolutoImagem = realpath($caminhoRelativoImagem);

        if ($caminhoAbsolutoImagem) {
            // Sobe duas pastas: /imagens -> /Peixe Agulha
            $pastaEspecie = dirname(dirname($caminhoAbsolutoImagem));

            if (apagarPasta($pastaEspecie)) {
                echo "Pasta da espécie apagada com sucesso.";
            } else {
                echo "Erro ao apagar a pasta da espécie.";
            }
        } else {
            echo "Caminho da imagem não encontrado.";
        }
    }
    $conexao->query("DELETE FROM imagens WHERE especie_id = $id");
    $conexao->query("DELETE FROM especies WHERE id = $id");
    header("Location: catalogo.php");
} else {
    header("Location: catalogo.php");
}
