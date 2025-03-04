<?php
// Iniciar sesión si no está activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cargar las entidades necesarias
require '../../Entity/Cancion.php';
require '../../Entity/Usuario.php';
require '../../Entity/Artista.php';

// Cargar el motor de plantillas Twig y el formulario de inicio de sesión
$twig = require_once __DIR__ . '/../../config/twig.php';
require ('loginForm.php');

// Inicializar el controlador de usuario
$controller = new \App\Controller\UserController(
    require_once __DIR__ . "/../../../doctrine-config.php"
);

try {
    // Crear un objeto Request con los datos de la petición HTTP
    $request = new \Symfony\Component\HttpFoundation\Request(
        $_GET,
        $_POST,
        [],
        $_COOKIE,
        $_FILES,
        $_SERVER
    );

    // Llamar al método settings del controlador
    $response = $controller->settings($request);
    
    // Mostrar el contenido de la respuesta
    echo $response->getContent();
    
} catch (\Exception $e) {
    // Mostrar mensaje de error en caso de excepción
    echo "<p style='color: #cc0000; margin-left: 12px'>Error: " . $e->getMessage() . "</p>";
}

// Configuración para mostrar todos los errores
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>