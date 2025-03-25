<?php

declare(strict_types=1);

use Adapters\Http\Router;

spl_autoload_register(function (string $class): void {
    $classPath = str_replace('App\\', '', $class);
    $file = __DIR__.'/../src/'.str_replace('\\', '/', $classPath).'.php';

    if (file_exists($file)) {
        require_once $file;
    }
});

spl_autoload_register(function (string $class): void {
    $file = __DIR__.'/../'.str_replace('\\', '/', $class).'.php';

    if (file_exists($file)) {
        require_once $file;
    }
});

// Load routing
/** @var Router $router */
$router = require __DIR__.'/../Adapters/Http/routes.php';

// Dispatch request
$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
