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

// Add a simple asset function
$twig->addFunction(new \Twig\TwigFunction('asset', function ($path) {
    return '../' . ltrim($path, '/');
}));

// Add path function
$twig->addFunction(new \Twig\TwigFunction('path', function ($name) {
    return '/';
}));

return $twig;