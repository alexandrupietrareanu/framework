<?php

declare(strict_types=1);

namespace App\Model;

class Product
{
    public function __construct(
        private ?int $id,
        private readonly string $name,
        private float $price
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function changePrice(float $newPrice): void
    {
        if ($newPrice <= 0) {
            throw new \InvalidArgumentException('Price must be positive.');
        }
        $this->price = $newPrice;
    }
}
