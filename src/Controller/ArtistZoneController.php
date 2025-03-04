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

/**
 * Controlador para gestionar la zona de artistas
 * Permite a los usuarios con rol de artista gestionar sus canciones
 */
class ArtistZoneController
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
     * Método principal que muestra la zona de artistas
     * @param Request $request Objeto de solicitud HTTP
     * @return Response Respuesta HTTP con la página renderizada
     */
    public function index(Request $request): Response
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Procesar la subida de canciones si se ha enviado el formulario
        if ($request->isMethod('POST') && $request->request->has('subir_cancion')) {
            return $this->handleSongUpload($request);
        }

        $usuarioSesion = $_SESSION['usuario'] ?? null;
        $error = null;
        $canciones = [];
        $isArtist = false;

        if ($usuarioSesion) {
            try {
                // Buscar el usuario en la base de datos
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

        // Obtener todos los artistas para el formulario de subida
        $allArtists = [];
        try {
            $allArtists = $this->entityManager->getRepository(Artista::class)->findAll();
        } catch (\Exception $e) {
            $error = $e->getMessage();
        }

        // Renderizar la plantilla con los datos necesarios
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

    /**
     * Método privado para manejar la subida de canciones
     * @param Request $request Objeto de solicitud HTTP con los datos del formulario
     * @return Response Redirección a la zona de artistas
     */
    private function handleSongUpload(Request $request): Response
    {
        try {
            // Obtener datos del formulario
            $nombreCancion = trim($request->request->get('nombreCancion'));
            $duracion = (int) $request->request->get('duracion');
            $artistasSeleccionados = $request->request->all()['artistas'] ?? [];  // Obtener artistas seleccionados
            $fechaInput = trim($request->request->get('fechaEstreno'));
            $fecha = \DateTime::createFromFormat('d/m/Y', $fechaInput);
            $cover = $request->files->get('cover');
            $usuarioActual = $_SESSION['usuario'];

            // Validar formato de fecha
            if (!$fecha) {
                $_SESSION['error_uploadsong'] = "Formato de fecha inválido. Use DD/MM/YYYY";
                return new RedirectResponse('zonaArtistas.php');
            }

            // Verificar que todos los campos requeridos estén completos
            if (!empty($nombreCancion) && $duracion > 0 && !empty($fecha) && $cover && !empty($artistasSeleccionados)) {
                // Preparar directorio para guardar la portada
                $uploadDir = __DIR__ . '/../public/imgs/covers/';
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                // Generar nombre único para el archivo
                $extension = pathinfo($cover->getClientOriginalName(), PATHINFO_EXTENSION);
                $nombreUnico = uniqid('cover_', true) . '.' . $extension;
                $rutaCompleta = $uploadDir . $nombreUnico;
                $rutaRelativa = '../imgs/covers/' . $nombreUnico;

                // Verificar extensión del archivo en lugar del tipo MIME
                if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png'])) {
                    // Mover el archivo subido al directorio de destino
                    $cover->move($uploadDir, $nombreUnico);

                    // Obtener usuario actual
                    $usuario = $this->entityManager->getRepository(Usuario::class)
                        ->findOneBy(['user' => $usuarioActual]);

                    // Crear nueva canción
                    $cancion = new Cancion($nombreCancion, $duracion, $fecha, $rutaRelativa, $usuario);

                    // Asociar artistas a la canción
                    foreach ($artistasSeleccionados as $nombreArtista) {
                        $artista = $this->entityManager->getRepository(Artista::class)
                            ->findOneBy(['nombre' => $nombreArtista]);
                        if ($artista) {
                            $cancion->getArtistas()->add($artista);
                        }
                    }

                    // Guardar en la base de datos
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

        // Redireccionar de vuelta a la zona de artistas
        return new RedirectResponse('zonaArtistas.php');
    }
}