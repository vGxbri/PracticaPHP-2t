<?php

namespace App\Controller;

use Entity\Usuario;
use Entity\Artista;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Controlador para gestionar las operaciones relacionadas con usuarios
 * Maneja la configuración de cuenta, actualización de datos y eliminación
 */
class UserController
{
    private $entityManager;
    private $twig;

    /**
     * Constructor del controlador
     * @param EntityManagerInterface $entityManager Gestor de entidades para interactuar con la base de datos
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->twig = require __DIR__ . '/../config/twig.php';
    }

    /**
     * Método para mostrar la página de configuración del usuario
     * @param Request $request Objeto de solicitud HTTP
     * @return Response Respuesta HTTP con la página de configuración
     */
    public function settings(Request $request): Response
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Crear un objeto Response con el contenido renderizado
        $content = $this->twig->render('user/settings.html.twig', [
            'usuario' => $_SESSION['usuario'] ?? null,
            'artista' => isset($_SESSION['artista']),
            'error_settings_user' => $_SESSION['error_settings_user'] ?? null,
            'error_settings_pass' => $_SESSION['error_settings_pass'] ?? null,
            'error_settings_delete' => $_SESSION['error_settings_delete'] ?? null,
            'success_settings' => $_SESSION['success_settings'] ?? null
        ]);
        
        return new Response($content);
    }

    /**
     * Método para actualizar el nombre de usuario
     * @param Request $request Objeto de solicitud HTTP con los datos del formulario
     * @return Response Redirección a la página de configuración
     */
    public function updateUsername(Request $request): Response
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario'])) {
            return new RedirectResponse('index.php');
        }

        if ($request->isMethod('POST')) {
            $usuarioActual = $_SESSION['usuario'];
            $usuarioNuevo = trim($request->request->get('usuario_nuevo'));

            // Verificar que el nuevo nombre sea diferente al actual
            if ($usuarioActual === $usuarioNuevo) {
                $_SESSION['error_settings_user'] = "El nuevo nombre de usuario debe ser diferente al actual.";
                return new RedirectResponse('settings.php');
            }

            try {
                $usuarioRepository = $this->entityManager->getRepository(Usuario::class);
                $usuarioExistente = $usuarioRepository->findOneBy(['user' => $usuarioNuevo]);

                // Verificar que el nuevo nombre no esté en uso
                if ($usuarioExistente) {
                    $_SESSION['error_settings_user'] = "El nombre de usuario ya está en uso.";
                } else {
                    $this->entityManager->beginTransaction();
                    $usuario = $usuarioRepository->findOneBy(['user' => $usuarioActual]);

                    if ($usuario) {
                        // Crear nuevo usuario con el hash de contraseña existente
                        $nuevoUsuario = new Usuario($usuarioNuevo, '', $usuario->getPasswordHash());
                        $nuevoUsuario->setEsArtista($usuario->isArtista());
                        
                        // Transferir canciones favoritas
                        foreach ($usuario->getCancionesFavoritas() as $cancion) {
                            $nuevoUsuario->addCancionFavorita($cancion);
                        }

                        // Transferir relación con artista si existe
                        if ($usuario->getArtista()) {
                            $artista = $usuario->getArtista();
                            $artista->setUser($nuevoUsuario);
                            $nuevoUsuario->setArtista($artista);
                        }

                        // Guardar cambios en la base de datos
                        $this->entityManager->persist($nuevoUsuario);
                        $this->entityManager->remove($usuario);
                        $this->entityManager->flush();
                        $this->entityManager->commit();
                        
                        // Actualizar sesión
                        $_SESSION['usuario'] = $usuarioNuevo;
                        $_SESSION['success_settings'] = "Nombre de usuario actualizado correctamente.";
                    }
                }
            } catch (\Exception $e) {
                $this->entityManager->rollback();
                $_SESSION['error_settings_user'] = "Error al actualizar el usuario: " . $e->getMessage();
            }
        }

        return new RedirectResponse('settings.php');
    }

    /**
     * Método para actualizar la contraseña del usuario
     * @param Request $request Objeto de solicitud HTTP con los datos del formulario
     * @return Response Redirección a la página de configuración
     */
    public function updatePassword(Request $request): Response
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario'])) {
            return new RedirectResponse('index.php');
        }

        if ($request->isMethod('POST')) {
            $passActual = trim($request->request->get('contrasena_actual'));
            $passNueva = trim($request->request->get('nueva_contrasena'));
            $passConfirm = trim($request->request->get('nueva_contrasena_confirmar'));

            // Verificar que las contraseñas nuevas coincidan
            if ($passNueva !== $passConfirm) {
                $_SESSION['error_settings_pass'] = "Las contraseñas no coinciden.";
                return new RedirectResponse('settings.php');
            }

            try {
                $this->entityManager->beginTransaction();
                
                $usuarioRepository = $this->entityManager->getRepository(Usuario::class);
                $usuario = $usuarioRepository->findOneBy(['user' => $_SESSION['usuario']]);
                $passActual = trim($request->request->get('contrasena_actual'));
                $passNueva = trim($request->request->get('nueva_contrasena'));
                $passConfirm = trim($request->request->get('nueva_contrasena_confirmar'));
                
                // Verificar que la contraseña actual sea correcta
                if ($usuario && password_verify($passActual, $usuario->getPasswordHash())) {
                    // Crear el hash y establecerlo
                    $nuevoHash = password_hash($passNueva, PASSWORD_DEFAULT);
                    $usuario->setPasswordHash($nuevoHash);
                    
                    // Guardar cambios
                    $this->entityManager->flush();
                    $this->entityManager->commit();
                    
                    $_SESSION['success_settings'] = "Contraseña actualizada correctamente.";
                } else {
                    $this->entityManager->rollback();
                    $_SESSION['error_settings_pass'] = "La contraseña actual es incorrecta.";
                }
            } catch (\Exception $e) {
                $this->entityManager->rollback();
                $_SESSION['error_settings_pass'] = "Error al actualizar la contraseña: " . $e->getMessage();
            }
        }

        return new RedirectResponse('settings.php');
    }

    /**
     * Método para eliminar la cuenta del usuario
     * @param Request $request Objeto de solicitud HTTP
     * @return Response Redirección a la página principal o de configuración
     */
    public function deleteAccount(Request $request): Response
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario'])) {
            return new RedirectResponse('index.php');
        }

        if ($request->isMethod('POST')) {
            try {
                $this->entityManager->beginTransaction();
                
                $usuarioRepository = $this->entityManager->getRepository(Usuario::class);
                $usuario = $usuarioRepository->findOneBy(['user' => $_SESSION['usuario']]);
                
                if ($usuario) {
                    // Primero, verificar si el usuario es un artista y manejar esa relación
                    if ($usuario->getArtista()) {
                        $artista = $usuario->getArtista();
                        
                        // Eliminar la asociación entre artista y usuario
                        $artista->setUser(null);
                        $usuario->setArtista(null);
                        
                        // Eliminar el artista
                        $this->entityManager->remove($artista);
                    }
                    
                    // Eliminar cualquier asociación con canciones favoritas
                    foreach ($usuario->getCancionesFavoritas() as $cancion) {
                        $usuario->removeCancionFavorita($cancion);
                    }
                    
                    // Ahora podemos eliminar el usuario de forma segura
                    $this->entityManager->remove($usuario);
                    $this->entityManager->flush();
                    $this->entityManager->commit();
                    
                    // Destruir la sesión y limpiar cookies
                    session_destroy();
                    setcookie('intentos_fallidos', '', time() - 3600, '/');
                    return new RedirectResponse('index.php');
                }
            } catch (\Exception $e) {
                $this->entityManager->rollback();
                $_SESSION['error_settings_delete'] = "Error al eliminar la cuenta: " . $e->getMessage();
            }
        }

        return new RedirectResponse('settings.php');
    }
}