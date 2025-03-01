<?php

namespace App\Controller;

use Entity\Cancion;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class SongController
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

        $query = $request->query->get('query', '');
        
        $qb = $this->entityManager->createQueryBuilder();
        $qb->select('c', 'a')
           ->from(Cancion::class, 'c')
           ->leftJoin('c.artistas', 'a');

        if (!empty($query)) {
            $qb->where('c.nombre LIKE :query')
               ->setParameter('query', '%' . $query . '%');
        }

        $canciones = $qb->getQuery()->getResult();

        $content = $this->twig->render('home/index.html.twig', [
            'canciones' => $canciones,
            'query' => $query,
            'error_addsong' => $_SESSION['error_addsong'] ?? null,
            'usuario' => $_SESSION['usuario'] ?? null,
            'artista' => isset($_SESSION['artista'])
        ]);

        return new Response($content);
    }
}