<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\Product;

interface ProductRepositoryInterface
{
    public function findById(int $id): ?Product;

    public function save(Product $product): void;
}
