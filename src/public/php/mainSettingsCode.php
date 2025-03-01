<?php
require_once '../../Entity/Usuario.php';
require_once '../../Entity/Artista.php';

use Entity\Usuario;

unset($_SESSION['error_settings_user']);
unset($_SESSION['error_settings_delete']);
unset($_SESSION['error_settings_pass']);

try {
    $entityManager = require_once __DIR__ . "/../../../doctrine-config.php";

    if (isset($_POST['cambiar_usuario'])) {
        $usuarioActual = $_SESSION['usuario'];
        $usuarioNuevo = trim($_POST['usuario_nuevo']);

        // Verificar si el nuevo nombre de usuario ya existe
        $usuarioRepository = $entityManager->getRepository(Usuario::class);
        $usuarioExistente = $usuarioRepository->findOneBy(['user' => $usuarioNuevo]);

        if ($usuarioExistente) {
            $_SESSION['error_settings_user'] = "El nombre de usuario ya está en uso.";
        } else {
            try {
                $entityManager->beginTransaction();

                // Obtener usuario actual
                $usuario = $usuarioRepository->findOneBy(['user' => $usuarioActual]);
                if ($usuario) {
                    // Crear nuevo usuario con los mismos datos
                    $nuevoUsuario = new Usuario($usuarioNuevo, '');
                    $nuevoUsuario->setPasswordHash($usuario->getPasswordHash());
                    $nuevoUsuario->setEsArtista($usuario->isArtista());
                    
                    // Transferir relaciones
                    foreach ($usuario->getCancionesFavoritas() as $cancion) {
                        $nuevoUsuario->addCancionFavorita($cancion);
                    }
                    
                    // Si es artista, actualizar la referencia
                    if ($usuario->getArtista()) {
                        $artista = $usuario->getArtista();
                        $artista->setUser($nuevoUsuario);
                        $nuevoUsuario->setArtista($artista);
                    }

                    // Persistir cambios
                    $entityManager->persist($nuevoUsuario);
                    $entityManager->remove($usuario);
                    $entityManager->flush();
                    $entityManager->commit();
                    
                    $_SESSION['usuario'] = $usuarioNuevo;
                }
            } catch (\Exception $e) {
                $entityManager->rollback();
                $_SESSION['error_settings_user'] = "Error al actualizar el usuario: " . $e->getMessage();
            }
        }
    }

    if (isset($_POST['cambiar_contrasena'])) {
        $passActualForm = trim($_POST['contrasena_actual']);
        $passNueva = trim($_POST['nueva_contrasena']);
        $passNueva2 = trim($_POST['nueva_contrasena_confirmar']);
        $usuarioActual = $_SESSION['usuario'];

        if ($passNueva !== $passNueva2) {
            $_SESSION['error_settings_pass'] = "Las contraseñas nuevas no coinciden.";
            return;
        }

        // Verificar contraseña actual
        $usuarioRepository = $entityManager->getRepository(Usuario::class);
        $usuario = $usuarioRepository->findOneBy(['user' => $usuarioActual]);

        if (!$usuario || !password_verify($passActualForm, $usuario->getPasswordHash())) {
            $_SESSION['error_settings_pass'] = "La contraseña actual es incorrecta.";
            return;
        }

        try {
            $usuario->setPasswordHash($passNueva);
            $entityManager->flush();
            $_SESSION['success_settings_pass'] = "Contraseña cambiada exitosamente.";
        } catch (\Exception $e) {
            $_SESSION['error_settings_pass'] = $e->getMessage();
        }
    }

    if (isset($_POST['eliminar_cuenta'])) {
        $usuarioABorrar = $_SESSION['usuario'];
        
        try {
            $entityManager->beginTransaction();
            
            $usuarioRepository = $entityManager->getRepository(Usuario::class);
            $usuario = $usuarioRepository->findOneBy(['user' => $usuarioABorrar]);
            
            if ($usuario) {
                // Doctrine manejará automáticamente la eliminación en cascada
                $entityManager->remove($usuario);
                $entityManager->flush();
                $entityManager->commit();
                require 'cerrarSesion.php';
            }
        } catch (\Exception $e) {
            $entityManager->rollback();
            $_SESSION['error_settings_delete'] = "Error al eliminar la cuenta: " . $e->getMessage();
        }
    }
} catch(\Exception $e) {
    $_SESSION['error_settings_user'] = "Error de conexión: " . $e->getMessage();
}
?>