<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require '../../Entity/Cancion.php';
require '../../Entity/Usuario.php';
require '../../Entity/Artista.php';

$twig = require_once __DIR__ . '/../../config/twig.php';
require ('loginForm.php');

// Inicializar el controlador
$controlador = new \App\Controller\HomeController(
    require_once __DIR__ . "/../../../doctrine-config.php"
);

try {
    // Crear objeto Request
    $peticion = new \Symfony\Component\HttpFoundation\Request(
        $_GET,
        $_POST,
        [],
        $_COOKIE,
        $_FILES,
        $_SERVER
    );

    // Llamar al método index
    $respuesta = $controlador->index($peticion);
    
    // Mostrar la respuesta
    echo $respuesta->getContent();
    
} catch (\Exception $e) {
    echo $twig->render('home/index.html.twig', [
        'usuario' => $_SESSION['usuario'] ?? null,
        'artista' => isset($_SESSION['artista']),
        'error' => $e->getMessage(),
        'canciones' => [],
        'query' => $_GET['query'] ?? '',
        'cancionActual' => null
    ]);
}