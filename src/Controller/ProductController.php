<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Product;
use App\Repository\ProductRepository;
use Twig\Environment;

class ProductController
{
    public function __construct(
        private ProductRepository $productRepository,
        private Environment $twig
    ) {}

    public function createForm(): void
    {
        echo $this->twig->render('products/create.twig');
    }

    // Processes the form submission and creates a new product.
    public function create(): void
    {
        $name  = trim($_POST['name'] ?? '');
        $price = trim($_POST['price'] ?? '');

        if (empty($name) || empty($price)) {
            echo $this->twig->render('products/create.twig', [
                'error' => 'Please provide both a product name and price.'
            ]);
            return;
        }

        $product = new Product(null, $name, (float)$price);
        $this->productRepository->save($product);

        // Redirect to the show page of the newly added product with its ID.
        header("Location: /show?productId=" . $product->getId());
        exit;
    }

    public function show(): void
    {
        $id = $_GET['productId'] ?? null;
        if (!$id) {
            echo $this->twig->render('notfound.twig');
            return;
        }
        $product = $this->productRepository->findById((int) $id);
        if (!$product) {
            echo $this->twig->render('notfound.twig');
            return;
        }
        echo $this->twig->render('products/show.twig', ['product' => $product]);
    }

}
