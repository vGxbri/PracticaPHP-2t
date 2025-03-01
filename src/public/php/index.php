<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require '../../Entity/Cancion.php';
require '../../Entity/Usuario.php';
require '../../Entity/Artista.php';

$twig = require_once __DIR__ . '/../../config/twig.php';
require ('loginForm.php');

// Get the current route
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Initialize the controller
$controller = new \App\Controller\SongController(
    require_once __DIR__ . "/../../../doctrine-config.php"
);

try {
    // Create a Request object
    $request = new \Symfony\Component\HttpFoundation\Request(
        $_GET,
        $_POST,
        [],
        $_COOKIE,
        $_FILES,
        $_SERVER
    );

    // C1ll the index method
    $response = $controller->index($request);
    
    // Render the response
    echo $response->getContent();
    
} catch (\Exception $e) {
    echo "<p style='color: #cc0000; margin-left: 12px'>Error: " . $e->getMessage() . "</p>";
}