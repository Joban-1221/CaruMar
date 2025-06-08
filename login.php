<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CaruMar - Login</title>
    <!-- Ícones do Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #166088;
            --secondary-color: #4a6fa5;
            --accent-color: #00bbf4;
            --light-accent: #6ddfff;
            --white: #ffffff;
            --dark-bg: #1a1a1a;
            --input-bg: rgba(255, 255, 255, 0.1);
            --input-focus: rgba(255, 255, 255, 0.2);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            background-color: var(--dark-bg);
            overflow: hidden;
        }

        .video-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .video-background video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.6;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
        }

        .login-card {
            background-color: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 40px 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .logo-container {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo-icon {
            font-size: 3rem;
            color: var(--accent-color);
            margin-bottom: 10px;
        }

        .logo-container h1 {
            font-size: 2rem;
            font-weight: 600;
            color: var(--white);
        }

        .login-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .input-group {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            color: rgba(255, 255, 255, 0.7);
            z-index: 1;
        }

        .form-input {
            width: 100%;
            padding: 15px 15px 15px 45px;
            background-color: var(--input-bg);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            color: var(--white);
            font-size: 1rem;
            transition: var(--transition);
        }

        .form-input:focus {
            outline: none;
            background-color: var(--input-focus);
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(0, 187, 244, 0.2);
        }

        .form-input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.6);
            cursor: pointer;
            font-size: 1rem;
        }

        .submit-btn {
            background-color: var(--accent-color);
            color: var(--white);
            border: none;
            padding: 15px;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .submit-btn:hover {
            background-color: var(--light-accent);
            transform: translateY(-2px);
        }

        .login-footer {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 10px;
            font-size: 0.9rem;
        }

        .back-link, .forgot-password {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .back-link:hover, .forgot-password:hover {
            color: var(--accent-color);
        }

        /* Mensagens de erro */
        .error-message {
            color: #ff6b6b;
            font-size: 0.9rem;
            margin-top: -15px;
            display: none;
        }

        /* Responsividade */
        @media (max-width: 480px) {
            .login-card {
                padding: 30px 20px;
            }
            
            .login-footer {
                flex-direction: column;
                gap: 10px;
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>
    <div class="video-background">
        <video autoplay muted loop>
            <source src="assets/videos/aquatic-background.mp4" type="video/mp4">
            <!-- Fallback para imagem caso o vídeo não carregue -->
            <img src="assets/images/aquatic-fallback.jpg" alt="Background aquático">
        </video>
    </div>

    <div class="login-container">
        <div class="login-card">
            <div class="logo-container">
                <i class="fas fa-fish logo-icon"></i>
                <h1>CaruMar</h1>
            </div>
            
            <form action="verificarLogin.php" method="POST" class="login-form">
                <div class="input-group">
                    <i class="fas fa-user input-icon"></i>
                    <input type="text" name="cpf" placeholder="CPF" class="form-input" required>
                </div>
                
                <div class="input-group">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" name="senha" placeholder="Senha" class="form-input" required>
                    <button type="button" class="toggle-password" aria-label="Mostrar senha">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                
                <button type="submit" class="submit-btn">
                    <i class="fas fa-sign-in-alt"></i> Entrar
                </button>
                
                <div class="login-footer">
                    <a href="index.php" class="back-link">
                        <i class="fas fa-arrow-left"></i> Paginca Inicial
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Mostrar/ocultar senha
        document.querySelector('.toggle-password').addEventListener('click', function() {
            const passwordInput = document.querySelector('input[name="senha"]');
            const icon = this.querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        });

        // Validação do CPF (apenas números)
        document.querySelector('input[name="cpf"]').addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '');
        });

        // Mostrar mensagens de erro do PHP
        <?php if (isset($_GET['erro'])): ?>
            const errorMessages = {
                'Campo_Vazio': 'Por favor, preencha todos os campos',
                'Dados_Incorretos': 'CPF ou senha incorretos'
            };
            
            const errorType = '<?php echo $_GET['erro']; ?>';
            alert(errorMessages[errorType] || 'Ocorreu um erro ao fazer login');
        <?php endif; ?>
    </script>
</body>

</html>