<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\Product;
use App\Entity\ProductPrice;

final class ProductPriceFactory
{
    public function make(
        Product $product,
        float $price,
        \DateTimeInterface $createdAt
    ): ProductPrice {
        $productPrice = new ProductPrice();
        $productPrice->setProduct($product);
        $productPrice->setPrice($price);
        $productPrice->setCreatedAt($createdAt);

        return $productPrice;
    }
}