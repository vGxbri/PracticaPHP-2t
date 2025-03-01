<?php
session_start();

require '../../Entity/Cancion.php';
require '../../Entity/Usuario.php';
require '../../Entity/Artista.php';

$twig = require_once __DIR__ . '/../../config/twig.php';

require ('loginForm.php');

require ('mainSettingsCode.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>UrbanMusic</title>
</head>
    <body>
        <?php
            echo $twig->render('components/navLeft.html.twig', [
                'artista' => isset($_SESSION['artista'])
            ]);
        ?>
        
        <div class="mainGeneral">
            <?php
                echo $twig->render('components/navTop.html.twig', [
                    'usuario' => $_SESSION['usuario'] ?? null
                ]);
            ?>
            <div class="main">
                <div class="titCanciones">
                    <h1 class="titCanciones-inside">Ajustes</h1>
                </div>
                <?php if (!isset($_SESSION['usuario'])) { ?>
                    <p style="font-weight: bold; color: #cc0000; margin-left: 12px">Necesitas iniciar sesión para acceder a tus ajustes.</p>
                <?php } else {
                    require 'mainSettings.php';
                }
                ?>
            </div>

            <?php
                echo $twig->render('components/navBottom.html.twig', [
                    'cancionActual' => $cancionActual ?? null
                ]);
            ?>
        </div>
    
    <script src="../js/script.js"></script>
    </body>
</html>