<?php
require_once '../../Entity/Usuario.php';
require_once '../../Entity/Artista.php';

use Entity\Usuario;
use Entity\Artista;

// Registrar usuario
if (isset($_POST['registrar'])) {
    try {
        $entityManager = require_once __DIR__ . "/../../../doctrine-config.php";

        // Datos del formulario
        $usuario = $_POST['usuario_registro'];
        $contrasena = $_POST['contrasena_registro'];
        $nombre_completo = $_POST['nombre_completo'];
        $contrasenaEncriptada = password_hash($contrasena, PASSWORD_DEFAULT);

        // Verificar si el usuario ya existe
        $usuarioRepository = $entityManager->getRepository(Usuario::class);
        $usuarioExistente = $usuarioRepository->findOneBy(['user' => $usuario]);

        if ($usuarioExistente) {
            $_SESSION['error_register'] = "El usuario ya está creado.";
        } else {
            try {
                $entityManager->beginTransaction();

                // Crear nuevo usuario
                $nuevoUsuario = new Usuario($usuario, $contrasena);
                $entityManager->persist($nuevoUsuario);

                // Si es artista, crear entrada en artistas
                if (isset($_POST['es_artista'])) {
                    $nuevoArtista = new Artista($nombre_completo, $nuevoUsuario);
                    $entityManager->persist($nuevoArtista);
                    $nuevoUsuario->setArtista($nuevoArtista);
                    $nuevoUsuario->setEsArtista(true);
                    $_SESSION['artista'] = true;
                }

                $entityManager->flush();
                $entityManager->commit();
                $_SESSION['usuario'] = $usuario;

            } catch (\Exception $e) {
                $entityManager->rollback();
                $_SESSION['error_register'] = $e->getMessage();
            }
        }
    } catch(\Exception $e) {
        $_SESSION['error_register'] = "Error de conexión: " . $e->getMessage();
    }

    header('Location: index.php');
    exit();
}

// Iniciar sesión
if (isset($_POST['iniciar_sesion'])) {
    try {
        $entityManager = require_once __DIR__ . "/../../../doctrine-config.php";

        $usuario = trim($_POST['usuario_login']);
        $contrasena = trim($_POST['contrasena_login']);

        // Buscar usuario
        $usuarioRepository = $entityManager->getRepository(Usuario::class);
        $user = $usuarioRepository->findOneBy(['user' => $usuario]);

        if ($user && password_verify($contrasena, $user->getPasswordHash())) {
            setcookie('intentos_fallidos', 0, time() - 3600, "/");
            $_SESSION['usuario'] = $usuario;

            // Verificar si es artista
            $artistaRepository = $entityManager->getRepository(Artista::class);
            $artista = $artistaRepository->findOneBy(['user' => $user]);
            
            if ($artista) {
                $_SESSION['artista'] = true;
            }
        } else {
            $_SESSION['error_login'] = $user ? "Contraseña no válida." : "Usuario no encontrado.";

            // Gestión de intentos fallidos
            if ($user) {
                $intentos = isset($_COOKIE['intentos_fallidos']) ? $_COOKIE['intentos_fallidos'] + 1 : 1;
                setcookie('intentos_fallidos', $intentos, time() + 600, "/");
            }
        }
    } catch(\Exception $e) {
        $_SESSION['error_login'] = "Error de conexión: " . $e->getMessage();
    }

    header('Location: index.php');
    exit();
}
?>