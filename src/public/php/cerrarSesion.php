<?php
// Inicializar la sesión.
session_start();

// Destruir todas las variables de sesión.
$_SESSION = array();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalmente, destruir la sesión completamente
session_destroy();

header('Location: index.php');
?>