<?php
include_once("verificarAdmin.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Espécie</title>
    <style>
        :root {
            --primary-color: #4a6fa5;
            --secondary-color: #166088;
            --background-color: #f8f9fa;
            --text-color: #333;
            --light-gray: #e9ecef;
            --border-radius: 6px;
            --box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            --success-color: #28a745;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        body {
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
            padding: 2rem;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 2rem;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: var(--secondary-color);
            font-weight: 600;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--secondary-color);
            font-size: 0.9rem;
        }

        input[type="text"],
        input[type="file"],
        select,
        textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: border 0.3s ease;
        }

        input[type="text"]:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(74, 111, 165, 0.2);
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        input[type="submit"] {
            background-color: var(--success-color);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: var(--border-radius);
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: block;
            margin: 2rem auto 0;
            width: 200px;
            font-weight: 500;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        .file-input-wrapper {
            position: relative;
            margin-bottom: 1rem;
        }

        .file-input-wrapper input[type="file"] {
            opacity: 0;
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 100%;
            cursor: pointer;
        }

        .btn-arquivos {
            background-color: var(--primary-color);
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s ease;
            display: inline-block;
            width: 100%;
            text-align: center;
        }

        .btn-arquivos:hover {
            background-color: var(--secondary-color);
        }

        #file-names {
            display: block;
            margin-top: 0.5rem;
            font-size: 0.8rem;
            color: #666;
        }

        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }
            
            .container {
                padding: 1.5rem;
            }
            
            .form-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Cadastro de Espécie</h2>
        <form action="verificacao.php" method="post" enctype="multipart/form-data">
            <div class="form-grid">
                <div class="form-group">
                    <label for="nomeP">Nome Popular</label>
                    <input type="text" id="nomeP" name="nomeP" maxlength="100">
                </div>

                <div class="form-group">
                    <label for="modeloOld">Identificação</label>
                    <input type="text" id="modeloOld" name="modeloOld" maxlength="50">
                </div>

                <div class="form-group">
                    <label for="nomeC">Nome Científico</label>
                    <input type="text" id="nomeC" name="nomeC" maxlength="100">
                </div>

                <div class="form-group">
                    <label for="reino">Reino</label>
                    <select id="reino" name="reino">
                        <option value="">Selecione...</option>
                        <option value="Animalia">Animalia</option>
                        <option value="Plantae">Plantae</option>
                        <option value="Fungi">Fungi</option>
                        <option value="Protista">Protista</option>
                        <option value="Monera">Monera</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <textarea id="descricao" name="descricao" rows="4"></textarea>
                </div>

                <div class="form-group">
                    <label for="imagens">Imagens</label>
                    <div class="file-input-wrapper">
                        <button type="button" class="btn-arquivos" onclick="document.getElementById('imagens').click()">Selecionar Arquivos</button>
                        <span id="file-names">Nenhum arquivo selecionado</span>
                        <input type="file" id="imagens" name="imagens[]" multiple>
                    </div>
                </div>

                <div class="form-group">
                    <label for="familia">Família</label>
                    <input type="text" id="familia" name="familia" maxlength="50">
                </div>

                <div class="form-group">
                    <label for="genero">Gênero</label>
                    <input type="text" id="genero" name="genero" maxlength="50">
                </div>

                <div class="form-group">
                    <label for="habitat">Habitat</label>
                    <textarea id="habitat" name="habitat" maxlength="255" rows="4"></textarea>
                </div>

                <div class="form-group">
                    <label for="estado">Estado de Conservação</label>
                    <input type="text" id="estado" name="estado" maxlength="50">
                </div>

                <div class="form-group">
                    <label for="usuario">Usuário</label>
                    <select id="usuario" name="usuario">
                        <option value="">Selecione...</option>
                        <option value="1">Jovan</option>
                        <option value="2">Klyssia</option>
                        <option value="3">Geise</option>
                    </select>
                </div>
            </div>

            <input type="submit" name="Cadastrar" value="Cadastrar">
        </form>
    </div>

    <script>
        document.getElementById('imagens').addEventListener('change', function() {
            const fileNames = Array.from(this.files).map(file => file.name).join(', ');
            document.getElementById('file-names').textContent = fileNames || 'Nenhum arquivo selecionado';
        });
    </script>
</body>
</html>