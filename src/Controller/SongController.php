<?php

namespace App\Controller;

use Entity\Cancion;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Controlador para gestionar las operaciones relacionadas con las canciones
 * Maneja la búsqueda, visualización y gestión de canciones
 */
class SongController
{
    private $entityManager;
    private $twig;

    /**
     * Constructor del controlador
     * @param EntityManagerInterface $entityManager Gestor de entidades para la base de datos
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->twig = require __DIR__ . '/../config/twig.php';
    }

    /**
     * Método para buscar canciones
     * @param Request $request Objeto de solicitud HTTP con los parámetros de búsqueda
     * @return Response Respuesta HTTP con los resultados de la búsqueda
     */
    public function search(Request $request): Response
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Obtener el término de búsqueda
        $query = $request->query->get('query', '');
        
        // Crear consulta para buscar canciones
        $qb = $this->entityManager->createQueryBuilder();
        $qb->select('c', 'a')
           ->from(Cancion::class, 'c')
           ->leftJoin('c.artistas', 'a')
           ->where('c.nombre LIKE :query')
           ->setParameter('query', '%' . $query . '%');
        
        try {
            // Ejecutar la búsqueda
            $canciones = $qb->getQuery()->getResult();
            
            // Renderizar la plantilla con los resultados
            $content = $this->twig->render('search/results.html.twig', [
                'canciones' => $canciones,
                'query' => $query,
                'usuario' => $_SESSION['usuario'] ?? null,
                'artista' => isset($_SESSION['artista'])
            ]);
            
            return new Response($content);
        } catch (\Exception $e) {
            // Manejar errores durante la búsqueda
            return new Response('Error en la búsqueda: ' . $e->getMessage());
        }
    }
}