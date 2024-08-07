<?php

namespace App\Tests\Service\PriceCalculator;

use App\Const\CouponTypeEnum;
use App\Entity\Coupon;
use App\Service\PriceCalculator\CouponPriceCalculationCommand;
use PHPUnit\Framework\TestCase;
use App\Entity\CountryTax;
use App\Service\PriceCalculator\CountryTaxPriceCalculationCommand;

class CalculationCommandsTest extends TestCase
{
    public function testCountryTaxCalculator(): void
    {
        $countryTax = new CountryTax();
        $countryTax->setValue(10);
        $calculator = new CountryTaxPriceCalculationCommand($countryTax);

        $this->assertSame(110., $calculator->calculate(100));
    }

    public function testCouponPriceCalculator(): void
    {
        $fixedCoupon = new Coupon();
        $fixedCoupon->setType(CouponTypeEnum::Fixed->value);
        $fixedCoupon->setValue(50);
        $calculator1 = new CouponPriceCalculationCommand($fixedCoupon);

        $this->assertSame(950., $calculator1->calculate(1000));

        $percentCoupon = new Coupon();
        $percentCoupon->setType(CouponTypeEnum::Percent->value);
        $percentCoupon->setValue(10);
        $calculator2 = new CouponPriceCalculationCommand($percentCoupon);

        $this->assertSame(900., $calculator2->calculate(1000));
    }
}
