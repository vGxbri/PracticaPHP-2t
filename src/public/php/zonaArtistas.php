<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Primero el autoloader
require_once __DIR__ . "/../../../vendor/autoload.php";

$twig = require_once __DIR__ . '/../../config/twig.php';

// Después las entidades
require_once '../../Entity/Cancion.php';
require_once '../../Entity/Usuario.php';
require_once '../../Entity/Artista.php';

use Entity\Usuario;

try {
    $entityManager = require __DIR__ . "/../../../doctrine-config.php";
    
    if (!$entityManager instanceof \Doctrine\ORM\EntityManager) {
        throw new \Exception("EntityManager no se inicializó correctamente");
    }
} catch (\Exception $e) {
    echo "<p style='color: red'>Error al cargar EntityManager: " . $e->getMessage() . "</p>";
    die();
}

$usuarioSesion = $_SESSION['usuario'];


require ('loginForm.php');
require ('uploadSongForm.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>UrbanMusic</title>
</head>
    <body>
        <?php
            echo $twig->render('components/navLeft.html.twig', [
                'artista' => isset($_SESSION['artista'])
            ]);
        ?>

        <div class="mainGeneral">
            <?php
                echo $twig->render('components/navTop.html.twig', [
                    'usuario' => $_SESSION['usuario'] ?? null
                ]);
            ?>

            <div class="main">
                <div class="titCanciones">
                    <h1 class="titCanciones-inside">Zona de artistas</h1>
                </div>
                <div class="botonesCreacionArtistas">
                    <ul class="boxTop-createSong">
                        <a class="boxTop-inside" id="uploadSong">
                            <div class="uploadSong">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1.2e" height="1.2e" viewBox="0 0 24 24"><path fill="white" d="M10 16h4c.55 0 1-.45 1-1v-5h1.59c.89 0 1.34-1.08.71-1.71L12.71 3.7a.996.996 0 0 0-1.41 0L6.71 8.29c-.63.63-.19 1.71.7 1.71H9v5c0 .55.45 1 1 1m-4 2h12c.55 0 1 .45 1 1s-.45 1-1 1H6c-.55 0-1-.45-1-1s.45-1 1-1"/></svg>
                                <p id="userNameTop">Subir canción</p>
                            </div>
                        </a>
                    </ul>
                </div>
                <div class="titCanciones">
                    <h2>Canciones subidas</h2>
                </div>
                <div class="songs">
                    <?php
                    try {
                        $usuarioRepository = $entityManager->getRepository(Usuario::class);
                        $usuario = $usuarioRepository->findOneBy(['user' => $usuarioSesion]);
                        
                        if (!$usuario) {
                            echo "<p style='color: red'>Error: Usuario no encontrado en la base de datos</p>";
                        } else {
                            $cancionArtistaEncontrada = false;
                            $artista = $usuario->getArtista();
                            
                            if (!$artista) {
                                echo "<p style='color: orange'>El usuario no es un artista</p>";
                            } else {
                                $canciones = $artista->getCanciones();
                                
                                foreach ($canciones as $index => $cancion) {
                                    $cancionArtistaEncontrada = true;
                                    $artistasNombres = [];
                                    foreach ($cancion->getArtistas() as $artistaCancion) {
                                        $artistasNombres[] = $artistaCancion->getNombre();
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
                                    echo                "<button class='buttonRemoveFrom' onclick=\"eliminarCancion('".$cancion->getId()."')\" data-index='".$index."'>";
                                    echo                    "<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'><g id='rellenar' fill='white'><path d='M8 11a1 1 0 1 0 0 2h8a1 1 0 1 0 0-2z'/><path fill-rule='evenodd' d='M23 12c0 6.075-4.925 11-11 11S1 18.075 1 12S5.925 1 12 1s11 4.925 11 11m-2 0a9 9 0 1 1-18 0a9 9 0 0 1 18 0' clip-rule='evenodd'/></g></svg>";
                                    echo                "</button>";
                                    echo            "</label>";
                                    echo        "</div>";
                                    echo    "</div>";
                                }
                            }
                        }
                    } catch(\Exception $e) {
                        echo "<p style='color: red; margin-left: 12px'>Error al cargar las canciones: " . $e->getMessage() . "</p>";
                    }
                    ?>
                </div>
                <?php
                if (!$cancionArtistaEncontrada) {
                    echo "<p style='font-weight: bold; color: red; margin: 0 0 12px 12px'>¡No tienes canciones subidas!</p>";
                }
                ?>
            </div>

            <?php
                echo $twig->render('components/navBottom.html.twig', [
                    'cancionActual' => $cancionActual ?? null
                ]);
            ?>
        </div>
    <script src="../js/script.js"></script>
    </body>
</html>