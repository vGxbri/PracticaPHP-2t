<?php

namespace App\Controller;

use Entity\Usuario;
use Entity\Cancion;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Controlador para gestionar la biblioteca personal del usuario
 * Maneja la visualización de las canciones favoritas
 */
class LibraryController
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
     * Método principal que muestra la biblioteca del usuario
     * @param Request $request Objeto de solicitud HTTP
     * @return Response Respuesta HTTP con la página de biblioteca renderizada
     */
    public function index(Request $request): Response
    {
        // Iniciar sesión si no está activa
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Obtener usuario de la sesión actual
        $usuarioSesion = $_SESSION['usuario'] ?? null;
        $favoritas = [];
        $error = null;

        // Si hay un usuario en sesión, obtener sus canciones favoritas
        if ($usuarioSesion) {
            try {
                $usuario = $this->entityManager->getRepository(Usuario::class)
                    ->findOneBy(['user' => $usuarioSesion]);

                if ($usuario) {
                    $favoritas = $usuario->getCancionesFavoritas();
                }
            } catch (\Exception $e) {
                $error = $e->getMessage();
            }
        }

        // Renderizar la plantilla con los datos necesarios
        $content = $this->twig->render('library/library.html.twig', [
            'usuario' => $usuarioSesion,
            'artista' => isset($_SESSION['artista']),
            'cancionesFavoritas' => $favoritas,
            'error' => $error
        ]);

        return new Response($content);
    }
}