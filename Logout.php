<?php
// logout.php - Página para encerrar a sessão do usuário

// Inicia a sessão se ainda não estiver ativa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Destroi todas as variáveis de sessão
$_SESSION = array();

// Se desejar destruir o cookie de sessão completamente,
// observe que isso destruirá a sessão, e não apenas os dados da sessão
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Finalmente, destrói a sessão
session_destroy();

// Redireciona para a página de login com mensagem de sucesso
header("Location: login.php?msg=logout_success");
exit();
?>