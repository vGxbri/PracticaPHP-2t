<?php
session_start();

// Importar las entidades necesarias
require '../../Entity/Usuario.php';
require '../../Entity/Artista.php';
require '../../Entity/Cancion.php';
require '../../Controller/UserController.php';

use App\Controller\UserController;

// Inicializar el controlador
$controller = new UserController(
    require_once __DIR__ . "/../../../doctrine-config.php"
);

// Crear un objeto Request con los datos de la petición HTTP
$request = new \Symfony\Component\HttpFoundation\Request(
    $_GET,
    $_POST,
    [],
    $_COOKIE,
    $_FILES,
    $_SERVER
);

// Obtener la acción solicitada desde la URL
$action = $_GET['action'] ?? '';

// Ejecutar la acción correspondiente según el parámetro recibido
switch ($action) {
    case 'update_username':
        $response = $controller->updateUsername($request);
        break;
    case 'update_password':
        $response = $controller->updatePassword($request);
        break;
    case 'delete_account':
        $response = $controller->deleteAccount($request);
        break;
    default:
        header('Location: settings.php');
        exit;
}

// Si tenemos una respuesta de redirección, seguirla
if ($response instanceof \Symfony\Component\HttpFoundation\RedirectResponse) {
    header('Location: ' . $response->getTargetUrl());
    exit;
}