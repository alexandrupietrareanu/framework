<?php

declare(strict_types=1);

namespace App;

class ServiceLocator
{
    /**
     * @var array<mixed>
     */
    private array $services = [];

    /**
     * @var array<mixed>
     */
    private array $instances = [];

    // Register a service with a factory function.
    public function set(string $name, callable $factory): void
    {
        $this->services[$name] = $factory;
    }

    // Retrieve an instance of the service, instantiating it if needed.
    public function get(string $name): mixed
    {
        if (!isset($this->instances[$name])) {
            if (isset($this->services[$name])) {
                $this->instances[$name] = $this->services[$name]($this);
            } else {
                throw new \Exception("Service '{$name}' not found.");
            }
        }

        return $this->instances[$name];
    }
}
