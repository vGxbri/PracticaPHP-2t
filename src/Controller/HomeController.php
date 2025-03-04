<?php

namespace App\Controller;

use Entity\Cancion;
use Entity\Usuario;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Controlador para la página principal
 * Gestiona la visualización de canciones y la búsqueda
 */
class HomeController
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
     * Método principal que muestra la página de inicio
     * @param Request $request Objeto de solicitud HTTP
     * @return Response Respuesta HTTP con la página renderizada
     */
    public function index(Request $request): Response
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Obtener el término de búsqueda desde la URL
        $terminoBusqueda = trim($request->query->get('query', ''));
        $repositorioCanciones = $this->entityManager->getRepository(Cancion::class);

        try {
            // Si hay un término de búsqueda, filtrar las canciones
            if (!empty($terminoBusqueda)) {
                $qb = $this->entityManager->createQueryBuilder();
                $qb->select('c', 'a')
                   ->from(Cancion::class, 'c')
                   ->leftJoin('c.artistas', 'a')
                   ->where('c.nombre LIKE :query')
                   ->setParameter('query', '%' . $terminoBusqueda . '%');
                
                $canciones = $qb->getQuery()->getResult();
            } else {
                // Si no hay búsqueda, mostrar todas las canciones
                $qb = $this->entityManager->createQueryBuilder();
                $qb->select('c', 'a')
                   ->from(Cancion::class, 'c')
                   ->leftJoin('c.artistas', 'a');
                
                $canciones = $qb->getQuery()->getResult();
            }

            // Renderizar la plantilla con los datos necesarios
            $content = $this->twig->render('home/index.html.twig', [
                'canciones' => $canciones,
                'query' => $terminoBusqueda,
                'error_addsong' => $_SESSION['error_addsong'] ?? null,
                'usuario' => $_SESSION['usuario'] ?? null,
                'artista' => isset($_SESSION['artista'])
            ]);

            // Limpiar mensajes de error después de mostrarlos
            unset($_SESSION['error_addsong']);
            
            return new Response($content);
            
        } catch (\Exception $e) {
            // En caso de error, mostrar una página con el mensaje de error
            $content = $this->twig->render('home/index.html.twig', [
                'usuario' => $_SESSION['usuario'] ?? null,
                'artista' => isset($_SESSION['artista']),
                'error' => $e->getMessage(),
                'canciones' => [],
                'query' => $terminoBusqueda
            ]);
            
            return new Response($content);
        }
    }
}