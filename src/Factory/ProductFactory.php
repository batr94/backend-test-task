<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\Product;

final class ProductFactory
{
    public function make(string $name): Product
    {
        $product = new Product();
        $product->setName($name);

        return $product;
    }
}