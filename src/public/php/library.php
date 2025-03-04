<?php
// Iniciar sesión si no está activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cargar las entidades necesarias
require '../../Entity/Cancion.php';
require '../../Entity/Usuario.php';
require '../../Entity/Artista.php';

// Cargar el motor de plantillas Twig
$twig = require_once __DIR__ . '/../../config/twig.php';
// Incluir el formulario de inicio de sesión
require ('loginForm.php');

// Inicializar el controlador de biblioteca
$controller = new \App\Controller\LibraryController(
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

    // Llamar al método index del controlador
    $response = $controller->index($request);
    
    // Mostrar el contenido de la respuesta
    echo $response->getContent();
    
} catch (\Exception $e) {
    // Mostrar mensaje de error en caso de excepción
    echo "<p style='color: #cc0000; margin-left: 12px'>Error: " . $e->getMessage() . "</p>";
}