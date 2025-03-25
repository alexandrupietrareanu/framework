<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Product;
use App\Repository\ProductRepository;

class ProductController
{
    private ProductRepository $productRepository;

    public function __construct()
    {
        $this->productRepository = new ProductRepository();
    }

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
