<?php
require_once __DIR__ . "/../../../vendor/autoload.php";
require_once '../../Entity/Usuario.php';
require_once '../../Entity/Cancion.php';
require_once '../../Entity/Artista.php';

use Entity\Cancion;
use Entity\Artista;
use Entity\Usuario;

if (isset($_POST['subir_cancion'])) {
    try {
        $entityManager = require __DIR__ . "/../../../doctrine-config.php";
        
        if (!$entityManager instanceof \Doctrine\ORM\EntityManager) {
            throw new \Exception("EntityManager no se inicializó correctamente");
        }

        // Procesar el formulario de la canción
        $nombreCancion = trim($_POST['nombreCancion']);
        $duracion = (int) $_POST['duracion'];
        $artistasSeleccionados = $_POST['artistas'];
        
        // Convertir el formato de fecha DD/MM/YYYY a YYYY-MM-DD
        $fechaInput = trim($_POST['fechaEstreno']);
        $fecha = \DateTime::createFromFormat('d/m/Y', $fechaInput);
        
        if (!$fecha) {
            $_SESSION['error_uploadsong'] = "Formato de fecha inválido. Use DD/MM/YYYY";
            return;
        }
        
        $cover = $_FILES['cover'];
        $usuarioActual = $_SESSION['usuario'];

        if (!empty($nombreCancion) && $duracion > 0 && !empty($fecha) && !empty($cover) && !empty($artistasSeleccionados)) {
            // Procesar la imagen del cover
            $uploadDir = __DIR__ . '/../imgs/covers/';
            
            // Crear el directorio si no existe
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileName = basename($cover['name']);
            $extension = pathinfo($fileName, PATHINFO_EXTENSION);
            $nombreUnico = uniqid('cover_', true) . '.' . $extension;
            $rutaCompleta = $uploadDir . $nombreUnico;
            
            // Ruta relativa para la base de datos
            $rutaRelativa = '../imgs/covers/' . $nombreUnico;

            if (in_array($cover['type'], ['image/jpeg', 'image/png', 'image/jpg']) &&
                move_uploaded_file($cover['tmp_name'], $rutaCompleta)) {

                try {
                    // Obtener el usuario actual
                    $usuarioRepository = $entityManager->getRepository(Usuario::class);
                    $usuario = $usuarioRepository->findOneBy(['user' => $usuarioActual]);

                    // Create the song with the correct $fecha variable
                    $cancion = new Cancion($nombreCancion, $duracion, $fecha, $rutaRelativa, $usuario);
                    
                    // Obtener y asociar artistas
                    $artistaRepository = $entityManager->getRepository(Artista::class);
                        
                    foreach ($artistasSeleccionados as $nombreArtista) {
                        $artista = $artistaRepository->findOneBy(['nombre' => $nombreArtista]);
                        if ($artista) {
                            $cancion->getArtistas()->add($artista);
                        }
                    }

                    // Persistir y guardar en la base de datos
                    $entityManager->persist($cancion);
                    $entityManager->flush();

                    $_SESSION['success_uploadsong'] = "Canción subida correctamente";
                    header('Location: zonaArtistas.php');
                    exit();

                } catch (\Exception $e) {
                    $_SESSION['error_uploadsong'] = "Error al guardar la canción: " . $e->getMessage();
                    return;
                }
            } else {
                $_SESSION['error_uploadsong'] = "Hubo un problema con el archivo del cover.";
                return;
            }
        } else {
            $_SESSION['error_uploadsong'] = "Todos los campos son obligatorios.";
            return;
        }
    } catch(\Exception $e) {
        $_SESSION['error_uploadsong'] = "Error de conexión: " . $e->getMessage();
        return;
    }
}
?>