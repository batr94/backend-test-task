<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Exception\ProductNotFoundException;
use Doctrine\Persistence\ManagerRegistry;

class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function getProduct(int $id): Product
    {
        $product = $this->find($id);

        if ($product === null) {
            throw new ProductNotFoundException($id);
        }

        return $product;
    }
}
