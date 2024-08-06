<?php

namespace App\Repository;

use App\Entity\CountryTax;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Exception\CountryTaxNotFoundException;
use Doctrine\Persistence\ManagerRegistry;

class CountryTaxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CountryTax::class);
    }

    public function getOneByPattern(string $pattern): CountryTax
    {
        $countryTax = $this->findOneBy(['serialNumberPattern' => $pattern]);

        if ($countryTax === null) {
            throw new CountryTaxNotFoundException();
        }

        return $countryTax;
    }
}
