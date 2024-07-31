<?php

declare(strict_types=1);

namespace App\Service\PriceCalculator;

use App\Entity\CountryTax;

final readonly class CountryTaxPriceCalculationCommand implements PriceCalculationCommandInterface
{
    public function __construct(private CountryTax $countryTax)
    {
    }

    public function calculate(float $initialPrice): float
    {
        return $initialPrice + ($initialPrice * $this->countryTax->getValue()) / 100;
    }
}