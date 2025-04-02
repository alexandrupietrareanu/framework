<?php

declare(strict_types=1);

namespace config;

use App\Controller\HomeController;
use App\ServiceLocator;
use App\Repository\ProductRepository;
use App\Controller\ProductController;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

// Load the DB configuration
$dbConfig = require __DIR__ . '/db.php';

// Instantiate the service locator
$serviceLocator = new ServiceLocator();

// Register Twig. Adjust the views path if needed.
$serviceLocator->set(Environment::class, function () {
    $loader = new FilesystemLoader(__DIR__ . '/../views');
    return new Environment($loader);
});

// Register the database connection
$serviceLocator->set('db', function () use ($dbConfig) {
    return new \PDO($dbConfig['dsn'], $dbConfig['user'], $dbConfig['pass']);
});

// Register repositories
$serviceLocator->set(ProductRepository::class, function () {
    return new ProductRepository();
});

// Register controllers
$serviceLocator->set(ProductController::class, function ($sl) {
    return new ProductController(
        $sl->get(ProductRepository::class),
        $sl->get(Environment::class)
    );
});

// Register HomeController.
$serviceLocator->set(HomeController::class, function ($sl) {
    return new HomeController(
        $sl->get(ProductRepository::class),
        $sl->get(Environment::class)
    );
});

return $serviceLocator;