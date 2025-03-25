<?php

declare(strict_types=1);

namespace Adapters\Persistence;

class InMemoryRepository
{
    /**
     * @var mixed[]
     */
    private array $storage = [];

    /**
     * @return null|array<class-string>
     */
    public function findById(int $id): ?array
    {
        return $this->storage[$id] ?? null;
    }

    /**
     * @param array<class-string> $data
     */
    public function save(int $id, array $data): void
    {
        $this->storage[$id] = $data;
    }
}
