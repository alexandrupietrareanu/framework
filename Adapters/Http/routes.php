<?php

declare(strict_types=1);

use Adapters\Http\Router;

$router = new Router();

// Home route for listing products.
$router->add('GET', '/', ['App\Controller\HomeController', 'index']);

// Map GET requests to render the form.
$router->add('GET', '/create', ['App\Controller\ProductController', 'createForm']);

// Map POST requests to handle form submission.
$router->add('POST', '/create', ['App\Controller\ProductController', 'create']);

// Map another route to show product details.
$router->add('GET', '/show', ['App\Controller\ProductController', 'show']);

return $router;
