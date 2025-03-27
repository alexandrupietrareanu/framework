<?php

declare(strict_types=1);

namespace Adapters\Http;

use App\ServiceLocator;

class Router
{
    /**
     * @var mixed[]
     */
    private array $routes = [];

    /**
     * @param array<string> $action
     */
    public function add(string $method, string $path, array $action): void
    {
        $this->routes[$method][$path] = $action;
    }

    public function dispatch(string $method, string $path, ServiceLocator $serviceLocator): void
    {
        $action = $this->routes[$method][$path] ?? null;

        if (!$action) {
            http_response_code(404);
            echo 'Not Found';

            return;
        }

        [$controllerClass, $controllerMethod] = $action;
        $controller = $serviceLocator->get($controllerClass);

        $callback = [$controller, $controllerMethod];

        if (!\is_callable($callback)) {
            throw new \RuntimeException('Action not callable');
        }

        \call_user_func($callback);
    }
}
