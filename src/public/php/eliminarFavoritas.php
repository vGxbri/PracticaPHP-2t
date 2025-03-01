<?php
session_start();

require '../../Entity/Cancion.php';
require '../../Entity/Usuario.php';
require '../../Entity/Artista.php';

use Entity\Cancion;
use Entity\Usuario;

error_reporting(E_ALL);
ini_set('display_errors', 1);

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

        // Eliminar la canción de favoritos
        $usuario->getCancionesFavoritas()->removeElement($cancion);
        $entityManager->flush();

        header('Location: library.php');
        exit();
    } catch(\Exception $e) {
        $_SESSION['error_library'] = "Error al eliminar la canción: " . $e->getMessage();
        header('Location: library.php');
        exit();
    }
}
?>