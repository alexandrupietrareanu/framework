<?php

declare(strict_types=1);

use Adapters\Http\Router;
use App\Controller\ProductController;
use App\Repository\ProductRepository;
use App\ServiceLocator;

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

// Initialize Service Locator
$serviceLocator = new ServiceLocator();

// Register a database connection (example using PDO)
$serviceLocator->set('db', function () {
    // Replace with your actual DSN, username, and password
    return new PDO('mysql:host=localhost;dbname=myapp', 'username', 'password');
});

// Register your ProductRepository, for example:
$serviceLocator->set('App\Repository\ProductRepository', function ($sl) {
    // Create and return your ProductRepository instance.
    return new ProductRepository(/* dependencies, e.g., DB connection */);
});

// Register your controller. The key here is the fully qualified class name.
$serviceLocator->set('App\Controller\ProductController', function ($sl) {
    return new ProductController(
        $sl->get('App\Repository\ProductRepository')
    );
});

// Load routes from routes.php, which returns a Router instance.
$router = require __DIR__.'/../Adapters/Http/routes.php';

// Dispatch the request, passing in the service locator.
$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI'], $serviceLocator);
