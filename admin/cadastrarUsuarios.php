<?php
include_once("verificarAdmin.php");
if($_SESSION["usuario_id"] != 1){
    header("Location: ../catalogo.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuário - CaruMar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #166088;
            --secondary-color: #4a6fa5;
            --accent-color: #00bbf4;
            --light-accent: #6ddfff;
            --dark-bg: #333333;
            --input-bg: #f5f5f5;
            --input-focus: #e8e8e8;
            --white: #ffffff;
            --text-color: #333333;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        body {
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .register-container {
            width: 100%;
            max-width: 420px;
        }

        .register-card {
            background-color: var(--dark-bg);
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transition: var(--transition);
        }

        .register-card:hover {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25);
        }

        .register-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .register-header h1 {
            color: var(--white);
            font-size: 28px;
            margin-bottom: 10px;
        }

        .register-header i {
            color: var(--accent-color);
            font-size: 2.5rem;
            margin-bottom: 15px;
        }

        .register-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .input-group {
            position: relative;
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-color);
        }

        .register-form input,
        .register-form select {
            width: 100%;
            padding: 15px 15px 15px 45px;
            border-radius: 8px;
            border: none;
            background-color: var(--input-bg);
            font-size: 16px;
            transition: var(--transition);
            color: var(--text-color);
        }

        .register-form input:focus,
        .register-form select:focus {
            outline: none;
            background-color: var(--input-focus);
            box-shadow: 0 0 0 3px rgba(0, 187, 244, 0.2);
        }

        .register-form input::placeholder {
            color: #666;
        }

        .register-form select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            cursor: pointer;
        }

        .select-arrow {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            color: var(--primary-color);
        }

        .submit-btn {
            background-color: var(--accent-color);
            color: var(--white);
            border: none;
            padding: 15px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            margin-top: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .submit-btn:hover {
            background-color: var(--light-accent);
            transform: translateY(-2px);
        }

        /* Validação do CPF */
        input[name="cpf"] {
            -moz-appearance: textfield;
        }

        input[name="cpf"]::-webkit-outer-spin-button,
        input[name="cpf"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Responsividade */
        @media (max-width: 480px) {
            .register-card {
                padding: 30px 20px;
            }
            
            .register-header h1 {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>
    <div class="register-container">
        <div class="register-card">
            <div class="register-header">
                <i class="fas fa-user-plus"></i>
                <h1>Registrar Usuário</h1>
            </div>
            
            <form action="verificarCadastro.php" method="POST" class="register-form">
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="usuario" placeholder="Nome de Usuário" required>
                </div>
                
                <div class="input-group">
                    <i class="fas fa-id-card"></i>
                    <input type="number" name="cpf" placeholder="CPF (somente números)" required>
                </div>
                
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="senha" placeholder="Senha" required>
                </div>
                
                <div class="input-group">
                    <i class="fas fa-shield-alt"></i>
                    <select name="is_admin" required>
                        <option value="" disabled selected>Nível de Acesso</option>
                        <option value="1">Administrador</option>
                        <option value="0">Usuário Comum</option>
                    </select>
                    <i class="fas fa-chevron-down select-arrow"></i>
                </div>
                
                <button type="submit" name="enviarCadastro" class="submit-btn">
                    <i class="fas fa-user-plus"></i> Registrar
                </button>
            </form>
        </div>
    </div>

    <script>
        // Validação do CPF (apenas números)
        document.querySelector('input[name="cpf"]').addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '');
        });

        // Feedback visual ao enviar o formulário
        document.querySelector('.register-form').addEventListener('submit', function() {
            const submitBtn = document.querySelector('.submit-btn');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Registrando...';
            submitBtn.disabled = true;
        });
    </script>
</body>

</html>