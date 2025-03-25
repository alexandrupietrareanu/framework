<?php

declare(strict_types=1);

use Adapters\Http\Router;

$router = new Router();

$router->add('GET', '/create', ['App\Controller\ProductController', 'create']);
$router->add('GET', '/show', ['App\Controller\ProductController', 'show']);

return $router;
