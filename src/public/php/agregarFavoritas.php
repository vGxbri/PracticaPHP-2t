<?php
session_start();

require '../../Entity/Cancion.php';
require '../../Entity/Usuario.php';
require '../../Entity/Artista.php';

use Entity\Cancion;
use Entity\Usuario;

error_reporting(E_ALL);
ini_set('display_errors', 1);

unset($_SESSION['error_addsong']);

// Verificar que se ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    $_SESSION['error_addsong'] = "Necesitas iniciar sesión para añadir canciones a tu biblioteca.";
    header('Location: index.php');
    exit();
}

// Verificar si se recibió el ID de la canción y el usuario
if (isset($_POST['song']) && isset($_SESSION['usuario'])) {
    try {
        $entityManager = require_once __DIR__ . "/../../../doctrine-config.php";

        // Obtener el usuario y la canción
        $usuarioRepository = $entityManager->getRepository(Usuario::class);
        $cancionRepository = $entityManager->getRepository(Cancion::class);

        $usuario = $usuarioRepository->findOneBy(['user' => $_SESSION['usuario']]);
        $cancion = $cancionRepository->find($_POST['song']);

        if (!$usuario || !$cancion) {
            throw new \Exception("Usuario o canción no encontrados");
        }

        // Verificar si la canción ya está en favoritos
        if (!$usuario->getCancionesFavoritas()->contains($cancion)) {
            $usuario->getCancionesFavoritas()->add($cancion);
            $entityManager->flush();
        }

        header('Location: index.php');
        exit();
    } catch(\Exception $e) {
        $_SESSION['error_addsong'] = "Error al guardar la canción: " . $e->getMessage();
        header('Location: index.php');
        exit();
    }
}
?>