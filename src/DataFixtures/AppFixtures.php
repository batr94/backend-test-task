<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Product;
use App\Entity\ProductPrice;
use App\Entity\Coupon;
use App\Entity\CountryTax;

class AppFixtures extends Fixture
{
    private const array PRODUCTS = [
        [
            'name' => 'Iphone',
            'price' => 100,
        ],
        [
            'name' => 'Наушники',
            'price' => 20,
        ],
        [
            'name' => 'Чехол',
            'price' => 10,
        ],
    ];

    private const array COUNTRY_TAXES = [
        [
            'name' => 'Germany',
            'pattern' => 'GEXXXXXXXXX',
            'value' => 19,
        ],
        [
            'name' => 'Italy',
            'pattern' => 'ITXXXXXXXXXXX',
            'value' => 22,
        ],
        [
            'name' => 'France',
            'pattern' => 'FRYYXXXXXXXXX',
            'value' => 20,
        ],
        [
            'name' => 'Greece',
            'pattern' => 'GRXXXXXXXXX',
            'value' => 24,
        ],
    ];

    private const array COUPONS = [
        [
            'name' => 'F50',
            'type' => 'fixed',
            'value' => 50,
        ],
        [
            'name' => 'P10',
            'type' => 'percent',
            'value' => 10
        ]
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::PRODUCTS as $productData) {
            $product = new Product();
            $product->setName($productData['name']);
            $productPrice = new ProductPrice();
            $productPrice->setPrice($productData['price']);
            $productPrice->setProduct($product);
            $productPrice->setCreatedAt(new \DateTimeImmutable());
            $manager->persist($product);
            $manager->persist($productPrice);
        }

        foreach (self::COUNTRY_TAXES as $taxData) {
            $countryTax = new CountryTax();
            $countryTax->setName($taxData['name']);
            $countryTax->setSerialNumberPattern($taxData['pattern']);
            $countryTax->setValue($taxData['value']);
            $manager->persist($countryTax);
        }

        foreach (self::COUPONS as $couponData) {
            $coupon = new Coupon();
            $coupon->setType($couponData['type']);
            $coupon->setName($couponData['name']);
            $coupon->setValue($couponData['value']);
            $manager->persist($coupon);
        }

        $manager->flush();
    }
}
