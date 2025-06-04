<?php
include_once("verificarAdmin.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Espécie</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            color: #555;
            font-weight: bold;
        }

        input[type="text"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 14px;
        }

        textarea {
            resize: vertical;
        }

        input[type="submit"] {
            background-color: #28a745;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        .file-input-wrapper {
            position: relative;
            margin-bottom: 20px;
        }

        .file-input-wrapper input[type="file"] {
            opacity: 0;
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 100%;
            cursor: pointer;
            z-index: -1;
        }

        .btn-arquivos {
            background-color: #007bff;
            color: white;
            padding: 10px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .btn-arquivos:hover {
            background-color: #0069d9;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Cadastro de Espécie</h2>
        <form action="verificacao.php" method="post" enctype="multipart/form-data">
            <label for="nomeP">Nome Popular:</label>
            <input type="text" id="nomeP" name="nomeP" maxlength="100">

            <label for="modeloOld">Identificação:</label>
            <input type="text" id="modeloOld" name="modeloOld" maxlength="50">

            <label for="nomeC">Nome Científico:</label>
            <input type="text" id="nomeC" name="nomeC" maxlength="100">

            <label for="reino">Reino:</label>
            <select id="reino" name="reino">
                <option value="">Selecione...</option>
                <option value="Animalia">Animalia</option>
                <option value="Plantae">Plantae</option>
                <option value="Fungi">Fungi</option>
                <option value="Protista">Protista</option>
                <option value="Monera">Monera</option>
            </select>

            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" rows="4"></textarea>

            <label for="imagens">Imagens:</label>
            <div class="file-input-wrapper">
                <button type="button" class="btn-arquivos" onclick="document.getElementById('imagens').click()">Selecionar Arquivos</button>
                <span id="file-names" style="display: block; margin-top: 10px; color: #555;"></span>
                <input type="file" id="imagens" name="imagens[]" multiple>
            </div>

            <label for="familia">Família:</label>
            <input type="text" id="familia" name="familia" maxlength="50">

            <label for="genero">Gênero:</label>
            <input type="text" id="genero" name="genero" maxlength="50">

            <label for="localizacao">Local:</label>
            <textarea type="text" id="localizacao" name="localizacao" maxlength="255" rows="4"></textarea>

            <label for="estado">Estado de Conservação:</label>
            <input type="text" id="estado" name="estado" maxlength="50">

            <label for="usuario">Usuario:</label>
            <select id="usuario" name="usuario">
                <option value="">Selecione...</option>
                <option value="1">Jovan</option>
                <option value="2">Klyssia</option>
                <option value="3">Geise</option>
            </select>

            <input type="submit" name="Cadastrar" value="Cadastrar">
        </form>
    </div>

    <script>
        document.getElementById('imagens').addEventListener('change', function() {
            const fileNames = Array.from(this.files).map(file => file.name).join(', ');
            document.getElementById('file-names').textContent = fileNames || 'Nenhum arquivo selecionado';
        });

        document.getElementById('videos').addEventListener('change', function() {
            const videoNames = Array.from(this.files).map(file => file.name).join(', ');
            document.getElementById('video-names').textContent = videoNames || 'Nenhum vídeo selecionado';
        });
    </script>
</body>

</html>
