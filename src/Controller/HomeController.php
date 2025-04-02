<?php
declare(strict_types=1);

namespace App\Controller;

use Adapters\Persistence\PostgresRepository;
use App\Repository\ProductRepository;
use Twig\Environment;

class HomeController
{
    public function __construct(
        private ProductRepository $productRepository,
        private Environment $twig
    ) {}

    public function index(): void
    {
        $products = $this->productRepository->findAll();
        echo $this->twig->render('home.twig', ['products' => $products]);
    }
}
