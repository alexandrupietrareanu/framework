<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Product;
use App\Repository\ProductRepository;

class ProductController
{
    public function __construct(private ProductRepository $productRepository) {}

    public function create(): void
    {
        $product = new Product(null, 'Fratii Karamazov', 20.00);
        $this->productRepository->save($product);

        echo "Product Created: {$product->getName()} with ID {$product->getId()}";
    }

    public function show(): void
    {
        $product = $this->productRepository->findById(2);
        if (!$product) {
            echo 'Product not found!';

            return;
        }
        echo "Product: {$product->getName()}, Price: {$product->getPrice()}";
    }
}
