<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar-se</title>
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            height: 100%;
            overflow: hidden;
        }

        body {
            background-color: #4c4c4c;
            display: flex;
            align-items: center;
            justify-content: center;

            font-family: Arial, Helvetica, sans-serif;
        }

        .video-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .divLogin {
            background-color: rgba(0, 0, 0, 0.4);
            padding: 50px 30px 50px 30px;
            border-radius: 20px;
            height: auto;
            width: 300px;
        }

        .divLogin h1 {
            text-align: center;
            padding: 0;
            margin: 0 0 15px;
            color: white;
        }

        .formLogin {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .formLogin input {
            margin: 10px 0 10px 0;
            border-radius: 3px;
            border: 0;
            height: 50px;
            font-size: 15px
        }

        .inputSenha,
        .inputCpf {
            padding-left: 10px;
            outline: 0;
        }

        .inputSenha:focus,
        .inputCpf:focus {
            background-color: rgb(232, 232, 232);
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
            height: 60px;
            color: white;
            font-size: 15px;
        }

        .inputEnviar:hover {
            background-color: rgb(109, 221, 255);
            cursor: pointer;
        }

        .mostrarP {
            color: white;
            padding: 10px;
            font-size: 15px;
            border-radius: 3px;
        }

        .btn-voltar {
            background-color: rgb(0, 187, 244);
            height: 50px;
            color: white;
            font-size: 15px;
            text-decoration: none;
            justify-content: center;
            align-items: center;
            display: flex;
            width: 100%;
            border-radius: 3px;
        }
        form{
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
    </style>
</head>

<body>
    <div class="divLogin">
        <h1>Login</h1>
        <div class="formLogin">
            <form action="verificarLogin.php" method="POST">
                <input type="number" name="cpf" placeholder="Cpf" class="inputCpf">
                <input type="password" name="senha" placeholder="Senha" class="inputSenha">
                <input type="Submit" placeholder="Enviar" class="inputEnviar" name="Submit">
            </form>
            <a href="./catalogoPublico.php" class="btn-voltar">Voltar</a>
        </div>
    </div>
    <?php
    if (isset($_GET['erro'])) {
        $erro = $_GET['erro'];
        $mensagem = ($erro == "Campo_Vazio") ? "Um dos campos fornecidos esta vazio" : (($erro == "Dados_Incorretos") ? "Os dados fornecidos estão incorretos" : "");
        echo "<script>alert('$mensagem')</script>";
    }
    ?>
    <?php
    if (isset($_POST['Submit'])) {
        $cpf = htmlspecialchars($_POST['cpf']);
        $senha = htmlspecialchars($_POST['senha']);
        $mostrar = '
        <div class="divLogin" style="margin-left: 50px;">
        <h1>Informações</h1>
        <divclass="formLogin">
            <p class="mostrarP">Cpf: ' . $cpf . '</p>
            <p class="mostrarP">Senha: ' . $senha . '</p>
        </div>   
    </div>
        ';
        echo $mostrar;
    }
    ?>
</body>

</html>