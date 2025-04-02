<?php

declare(strict_types=1);

use Dotenv\Dotenv;

// Require Composer's autoloader (which also loads vlucas/phpdotenv)
require __DIR__.'/../vendor/autoload.php';

// Load environment variables from .env
$dotenv = Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

// Register your class autoloaders (if you're not fully relying on Composer)
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

// Load the preconfigured service locator
$serviceLocator = require __DIR__.'/../config/services.php';

// Load routes from routes.php
$router = require __DIR__.'/../Adapters/Http/routes.php';

// Dispatch the request, passing in the service locator.
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$router->dispatch($_SERVER['REQUEST_METHOD'], $uri, $serviceLocator);
