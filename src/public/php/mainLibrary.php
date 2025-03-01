<?php
require_once '../../Entity/Usuario.php';
require_once '../../Entity/Cancion.php';

use Entity\Usuario;

$usuarioSesion = $_SESSION['usuario'];

try {
    $entityManager = require_once __DIR__ . "/../../../doctrine-config.php";

    // Obtener el usuario actual
    $usuarioRepository = $entityManager->getRepository(Usuario::class);
    $usuario = $usuarioRepository->findOneBy(['user' => $usuarioSesion]);

    if ($usuario) {
        $cancionesFavoritas = $usuario->getCancionesFavoritas();

        if (!$cancionesFavoritas->isEmpty()) {
            echo "<div class='favSongs'>";
            foreach ($cancionesFavoritas as $index => $cancion) {
                $artistas = $cancion->getArtistas();
                $artistasNombres = [];
                foreach ($artistas as $artista) {
                    $artistasNombres[] = $artista->getNombre();
                }
                $artistasString = implode(', ', $artistasNombres);

                echo    "<div class='favSongs-inside'>";
                echo        "<div class='columnLeftFavs'>";
                echo            "<img src='".$cancion->getCover()."' class='coverFavs'>";
                echo            "<div class='infoFavSongs'>";
                echo                "<h2 class='titSongFavs'>".$cancion->getNombre()."</h2>";
                echo                "<p class='artistFavs'>".$artistasString."</p>";
                echo            "</div>";
                echo        "</div>";
                echo        "<div class='columnRightFavs'>";
                echo            "<label class='removeFrom'>";
                echo                "<button class='buttonRemoveFrom' onclick=\"eliminarCancionBiblioteca('".$cancion->getId()."')\" data-index='".$index."'>";
                echo                    "<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'><g id='rellenar' fill='white'><path d='M8 11a1 1 0 1 0 0 2h8a1 1 0 1 0 0-2z'/><path fill-rule='evenodd' d='M23 12c0 6.075-4.925 11-11 11S1 18.075 1 12S5.925 1 12 1s11 4.925 11 11m-2 0a9 9 0 1 1-18 0a9 9 0 0 1 18 0' clip-rule='evenodd'/></g></svg>";
                echo                "</button>";
                echo            "</label>";
                echo        "</div>";
                echo    "</div>";
            }
            echo "</div>";
        } else {
            echo "<p style='font-weight: bold; color: red; margin-left: 12px'>¡No tienes canciones guardadas!</p>";
        }
    } else {
        echo "<p style='color: #cc0000; margin-left: 12px'>Usuario no encontrado.</p>";
    }
} catch(\Exception $e) {
    echo "<p style='color: #cc0000; margin-left: 12px'>Error: " . $e->getMessage() . "</p>";
}
?>