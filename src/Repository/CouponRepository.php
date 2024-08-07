<?php

namespace App\Repository;

use App\Entity\Coupon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Exception\CouponNotFoundException;
use Doctrine\Persistence\ManagerRegistry;

class CouponRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Coupon::class);
    }

    public function findOneByName(string $name): ?Coupon
    {
        return $this->findOneBy(['name' => $name]);
    }

    public function getByName(string $name): Coupon
    {
        $coupon = $this->findOneByName($name);

        if ($coupon === null) {
            throw new CouponNotFoundException($name);
        }

        return $coupon;
    }
}
