<?php
session_start();

require '../../Entity/Cancion.php';
require '../../Entity/Usuario.php';
require '../../Entity/Artista.php';

require ('loginForm.php');

$twig = require_once __DIR__ . '/../../config/twig.php';

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
                <?php
                    require ('main.php');
                ?>
            </div>n

            <?php
                echo $twig->render('components/navBottom.html.twig', [
                    'cancionActual' => $cancionActual ?? null
                ]);
            ?>
        </div>
        
    <script src="../js/script.js"></script>
    </body>
</html>