<?php

declare(strict_types=1);

namespace App\Repository;

use Adapters\Persistence\Connection;
use Adapters\Persistence\PostgresRepository;
use App\Mapper\ProductDataMapper;
use App\Model\Product;

class ProductRepository implements ProductRepositoryInterface
{
    private string $table = 'products';

    private PostgresRepository $repository;

    public function __construct()
    {
        $this->repository = new PostgresRepository(new Connection());
    }

    /**
     * Returns an array of Product models.
     *
     * @return Product[]
     */
    public function findAll(): array
    {
        $rows = $this->repository->findAll($this->table);
        $products = [];
        foreach ($rows as $row) {
            $products[] = new Product(
                (int)$row['id'],
                $row['name'],
                (float)$row['price']
            );
        }
        return $products;
    }

    public function findById(int $id): ?Product
    {
        $data = $this->repository->findById('products', $id);

        return $data ? ProductDataMapper::toDomain($data) : null;
    }

    public function save(Product $product): void
    {
        $data = ProductDataMapper::fromDomain($product);
        $isNew = empty($data['id']);

        $this->repository->save('products', $data);

        if ($isNew) {
            $generatedId = $this->repository->getLastInsertedId('products');
            $product->setId($generatedId);
        }
    }
}
