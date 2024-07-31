<?php

namespace App\Repository;

use App\Entity\Coupon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\Persistence\ManagerRegistry;

class CouponRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Coupon::class);
    }

    public function getByName(string $name): Coupon
    {
        $coupon = $this->findOneBy(['name' => $name]);

        if ($coupon === null) {
            throw new EntityNotFoundException();
        }

        return $coupon;
    }
}
