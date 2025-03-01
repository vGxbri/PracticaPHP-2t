<?php

namespace App\Controller;

use Entity\Usuario;
use Entity\Cancion;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class LibraryController
{
    private $entityManager;
    private $twig;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->twig = require __DIR__ . '/../config/twig.php';
    }

    public function index(Request $request): Response
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $usuarioSesion = $_SESSION['usuario'] ?? null;
        $favoritas = [];
        $error = null;

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

        $content = $this->twig->render('library/library.html.twig', [
            'usuario' => $usuarioSesion,
            'artista' => isset($_SESSION['artista']),
            'cancionesFavoritas' => $favoritas,
            'error' => $error
        ]);

        return new Response($content);
    }
}