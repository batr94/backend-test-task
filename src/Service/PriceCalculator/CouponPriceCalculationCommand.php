<?php

declare(strict_types=1);

namespace App\Service\PriceCalculator;

use App\Const\CouponTypeEnum;
use App\Entity\Coupon;

final readonly class CouponPriceCalculationCommand implements PriceCalculationCommandInterface
{
    public function __construct(private Coupon $coupon)
    {
    }

    public function calculate(float $initialPrice): float
    {
        return max($initialPrice - $this->getCouponValue($initialPrice), 0);
    }

    private function getCouponValue(float $price): float
    {
        if ($this->coupon->getType() === CouponTypeEnum::Fixed) {
            return $price - $this->coupon->getValue();
        }

        return $price * $this->coupon ->getValue() / 100;
    }
}