<?php

declare(strict_types=1);

namespace App\Service\PriceCalculator;

interface PriceCalculationCommandInterface
{
    public function calculate(float $initialPrice): float;
}