<?php

namespace App\Controller;

use Entity\Cancion;
use Entity\Usuario;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

class HomeController
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

        $terminoBusqueda = trim($request->query->get('query', ''));
        $repositorioCanciones = $this->entityManager->getRepository(Cancion::class);

        try {
            if (!empty($terminoBusqueda)) {
                // Buscar por nombre de canción o nombre de artista
                $consultaCanciones = $repositorioCanciones->createQueryBuilder('c')
                    ->leftJoin('c.artistas', 'a')
                    ->where('c.nombre LIKE :terminoBusqueda')
                    ->orWhere('a.nombre LIKE :terminoBusqueda')
                    ->setParameter('terminoBusqueda', '%' . $terminoBusqueda . '%')
                    ->orderBy('c.nombre', 'ASC');

                $canciones = $consultaCanciones->getQuery()->getResult();
            } else {
                // Si no hay búsqueda, obtener todas las canciones
                $canciones = $repositorioCanciones->findAll();
            }

            $contenido = $this->twig->render('home/index.html.twig', [
                'usuario' => $_SESSION['usuario'] ?? null,
                'artista' => isset($_SESSION['artista']),
                'canciones' => $canciones,
                'query' => $terminoBusqueda,
                'cancionActual' => null
            ]);

            return new Response($contenido);
        } catch (\Exception $e) {
            $contenido = $this->twig->render('home/index.html.twig', [
                'usuario' => $_SESSION['usuario'] ?? null,
                'artista' => isset($_SESSION['artista']),
                'error' => $e->getMessage(),
                'canciones' => [],
                'query' => $terminoBusqueda,
                'cancionActual' => null
            ]);

            return new Response($contenido);
        }
    }
}