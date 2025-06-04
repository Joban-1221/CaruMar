<?php
include_once("verificarAdmin.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuário</title>
    <style>
        html, body {
            margin: 0;
            padding: 0;
        }

        body {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .divRegistrar {
            background-color: #333333;
            padding: 50px 30px;
            border-radius: 20px;
            height: auto;
            width: 300px;
            margin-top: 40px;
            box-shadow: 0 4px 10px rgb(0, 0, 0);
        }

        .divRegistrar h1 {
            text-align: center;
            margin: 0 0 15px;
            color: white;
        }

        .formRegistrar {
            display: flex;
            flex-direction: column;
        }

        .formRegistrar input,
        .formRegistrar select {
            margin: 10px 0;
            border-radius: 3px;
            border: 0;
            height: 50px;
            font-size: 15px;
            padding-left: 10px;
        }

        .formRegistrar input:focus,
        .formRegistrar select:focus {
            background-color: rgb(232, 232, 232);
            outline: none;
        }

        .inputCpf::-webkit-outer-spin-button,
        .inputCpf::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .inputCpf {
            -moz-appearance: textfield;
        }

        .inputEnviar {
            background-color: rgb(0, 187, 244);
            color: white;
            font-size: 15px;
            cursor: pointer;
        }

        .inputEnviar:hover {
            background-color: rgb(109, 221, 255);
        }
    </style>
</head>

<body>
    <div class="divRegistrar">
        <h1>Registrar</h1>
        <form action="verificarCadastro.php" method="POST" class="formRegistrar">
            <input name="usuario" type="text" placeholder="Nome de Usuário" required>
            <input name="cpf" type="number" placeholder="CPF (somente números)" class="inputCpf" required>
            <input name="senha" type="password" placeholder="Senha" required>
            <select name="is_admin" required>
                <option value="" disabled selected>Administrador?</option>
                <option value="1">Sim</option>
                <option value="0">Não</option>
            </select>
            <input type="submit" name="enviarCadastro" value="Registrar" class="inputEnviar">
        </form>
    </div>
</body>

</html>
