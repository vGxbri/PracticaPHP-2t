<?php
require_once __DIR__ . '/../../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader([
    __DIR__ . '/../public/templates'
]);

$twig = new \Twig\Environment($loader, [
    'cache' => __DIR__ . '/../cache/twig',
    'debug' => true,
    'auto_reload' => true
]);

$twig->addFunction(new \Twig\TwigFunction('asset', function ($path) {
    return '../' . ltrim($path, '/');
}));

// Añadir función de directorios
$twig->addFunction(new \Twig\TwigFunction('path', function ($name, $parameters = []) {
    $routes = [
        'home' => 'index.php',
        'library' => 'library.php',
        'artist_zone' => 'zonaArtistas.php',
        'user_settings' => 'settings.php',
        'user_update_username' => 'mainSettingsCode.php?action=update_username',
        'user_update_password' => 'mainSettingsCode.php?action=update_password',
        'user_delete_account' => 'mainSettingsCode.php?action=delete_account'
    ];
    
    $path = $routes[$name] ?? '/';
    
    if (!empty($parameters)) {
        $path .= (strpos($path, '?') !== false ? '&' : '?') . http_build_query($parameters);
    }
    
    return $path;
}));

return $twig;