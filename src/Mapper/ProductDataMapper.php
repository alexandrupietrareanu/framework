<?php

declare(strict_types=1);

namespace App\Mapper;

use App\Model\Product;

class ProductDataMapper
{
    /**
     * @param array<null|float|int|string> $data
     */
    public static function toDomain(array $data): Product
    {
        return new Product(
            (int) ($data['id'] ?? null),
            (string) $data['name'],
            (float) $data['price']
        );
    }

    /**
     * @return array<string, null|float|int|string>
     */
    public static function fromDomain(Product $product): array
    {
        return [
            'id' => $product->getId(),
            'name' => $product->getName(),
            'price' => $product->getPrice(),
        ];
    }
}
