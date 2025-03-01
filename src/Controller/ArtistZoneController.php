<?php

namespace App\Controller;

use Entity\Usuario;
use Entity\Artista;
use Entity\Cancion;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class ArtistZoneController
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

        // Handle song upload if form was submitted
        if ($request->isMethod('POST') && $request->request->has('subir_cancion')) {
            return $this->handleSongUpload($request);
        }

        $usuarioSesion = $_SESSION['usuario'] ?? null;
        $error = null;
        $canciones = [];
        $isArtist = false;

        if ($usuarioSesion) {
            try {
                $usuario = $this->entityManager->getRepository(Usuario::class)
                    ->findOneBy(['user' => $usuarioSesion]);

                if ($usuario) {
                    $artista = $usuario->getArtista();
                    if ($artista) {
                        $isArtist = true;
                        $canciones = $artista->getCanciones();
                    }
                }
            } catch (\Exception $e) {
                $error = $e->getMessage();
            }
        }

        // Get all artists for the upload form
        $allArtists = [];
        try {
            $allArtists = $this->entityManager->getRepository(Artista::class)->findAll();
        } catch (\Exception $e) {
            $error = $e->getMessage();
        }

        $content = $this->twig->render('zona/zonaArtistas.html.twig', [
            'usuario' => $usuarioSesion,
            'artista' => isset($_SESSION['artista']),
            'isArtist' => $isArtist,
            'canciones' => $canciones,
            'allArtists' => $allArtists,
            'error' => $error,
            'error_uploadsong' => $_SESSION['error_uploadsong'] ?? null
        ]);

        return new Response($content);
    }

    private function handleSongUpload(Request $request): Response
    {
        try {
            $nombreCancion = trim($request->request->get('nombreCancion'));
            $duracion = (int) $request->request->get('duracion');
            $artistasSeleccionados = $request->request->all()['artistas'] ?? [];  // Changed this line
            $fechaInput = trim($request->request->get('fechaEstreno'));
            $fecha = \DateTime::createFromFormat('d/m/Y', $fechaInput);
            $cover = $request->files->get('cover');
            $usuarioActual = $_SESSION['usuario'];

            if (!$fecha) {
                $_SESSION['error_uploadsong'] = "Formato de fecha inválido. Use DD/MM/YYYY";
                return new RedirectResponse('zonaArtistas.php');
            }

            if (!empty($nombreCancion) && $duracion > 0 && !empty($fecha) && $cover && !empty($artistasSeleccionados)) {
                $uploadDir = __DIR__ . '/../../public/imgs/covers/';
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $extension = pathinfo($cover->getClientOriginalName(), PATHINFO_EXTENSION);
                $nombreUnico = uniqid('cover_', true) . '.' . $extension;
                $rutaCompleta = $uploadDir . $nombreUnico;
                $rutaRelativa = '../imgs/covers/' . $nombreUnico;

                // Check file extension instead of MIME type
                if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png'])) {
                    $cover->move($uploadDir, $nombreUnico);

                    // Get current user
                    $usuario = $this->entityManager->getRepository(Usuario::class)
                        ->findOneBy(['user' => $usuarioActual]);

                    // Create new song
                    $cancion = new Cancion($nombreCancion, $duracion, $fecha, $rutaRelativa, $usuario);

                    // Associate artists
                    foreach ($artistasSeleccionados as $nombreArtista) {
                        $artista = $this->entityManager->getRepository(Artista::class)
                            ->findOneBy(['nombre' => $nombreArtista]);
                        if ($artista) {
                            $cancion->getArtistas()->add($artista);
                        }
                    }

                    $this->entityManager->persist($cancion);
                    $this->entityManager->flush();

                    $_SESSION['success_uploadsong'] = "Canción subida correctamente";
                } else {
                    $_SESSION['error_uploadsong'] = "Formato de imagen no válido";
                }
            } else {
                $_SESSION['error_uploadsong'] = "Todos los campos son obligatorios";
            }
        } catch (\Exception $e) {
            $_SESSION['error_uploadsong'] = "Error: " . $e->getMessage();
        }

        return new RedirectResponse('zonaArtistas.php');
    }
}