<?php

declare(strict_types=1);

namespace App\Service\PriceCalculator;

final class PriceCalculatorService
{
    /** @var PriceCalculationCommandInterface[] */
    private array $commands = [];

    public function addPriceCalculationCommand(PriceCalculationCommandInterface $command): void
    {
        $this->commands[] = $command;
    }

    public function calculate(float $initialPrice): float
    {
        $price = $initialPrice;

        foreach ($this->commands as $command) {
            $price = $command->calculate($price);
        }

        return $price;
    }
}