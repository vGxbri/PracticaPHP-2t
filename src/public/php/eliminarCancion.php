<?php
session_start();
require_once '../../Entity/Usuario.php';
require_once '../../Entity/Artista.php';
require_once '../../Entity/Cancion.php';

use Entity\Usuario;
use Entity\Artista;
use Entity\Cancion;

error_reporting(E_ALL);
ini_set('display_errors', 1);

$idCancion = trim($_POST['song']);

try {
    $entityManager = require_once __DIR__ . "/../../../doctrine-config.php";
    
    // Comenzar transacción
    $entityManager->beginTransaction();

    // Buscar la canción
    $cancionRepository = $entityManager->getRepository(Cancion::class);
    $cancion = $cancionRepository->find($idCancion);

    if ($cancion) {
        // Get the absolute path to the cover image
        $coverPath = str_replace('../', '', $cancion->getCover());
        $coverFullPath = __DIR__ . '/../' . $coverPath;
        
        // Delete the cover file if it exists
        if (file_exists($coverFullPath)) {
            unlink($coverFullPath);
        }

        // Delete the song from database
        $entityManager->remove($cancion);
        $entityManager->flush();
        $entityManager->commit();
    }

    header('Location: zonaArtistas.php');
    exit();

} catch(\Exception $e) {
    // Si hay error, deshacer cambios
    if ($entityManager->getConnection()->isTransactionActive()) {
        $entityManager->rollback();
    }
    $_SESSION['error_delete'] = "Error al eliminar la canción: " . $e->getMessage();
    header('Location: zonaArtistas.php');
    exit();
}
?>