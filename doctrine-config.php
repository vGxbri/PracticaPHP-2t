<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

require_once "vendor/autoload.php";

// Ruta absoluta para las entidades
$paths = [__DIR__ . "/src/Entity"];
$isDevMode = true;

// Configuración de caché
$cache = new FilesystemAdapter();

// Configuración de Doctrine con anotaciones
$config = ORMSetup::createAttributeMetadataConfiguration(
    $paths,
    $isDevMode,
    null,
    $cache
);

// Habilitar el modo de desarrollo
$config->setAutoGenerateProxyClasses(true);

// Configuración de la base de datos
$dbParams = [
    'driver'   => 'pdo_mysql',
    'host'     => 'localhost',
    'user'     => 'root',
    'password' => '',
    'dbname'   => 'plataforma_musica',
    'charset'  => 'utf8mb4'
];

try {
    // Crear la conexión
    $connection = DriverManager::getConnection($dbParams, $config);
    
    // Crear el EntityManager usando el constructor directamente
    $entityManager = new EntityManager($connection, $config);
    
    // Verificar que el EntityManager es válido
    if (!$entityManager instanceof EntityManager) {
        throw new \Exception("Error al crear el EntityManager");
    }
    
    return $entityManager;
} catch (\Exception $e) {
    echo "Error de conexión: " . $e->getMessage() . "<br>";
    echo "<pre>Stack trace:<br>";
    echo $e->getTraceAsString();
    echo "</pre>";
    die();
}