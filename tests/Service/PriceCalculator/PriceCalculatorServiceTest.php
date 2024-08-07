<?php

namespace App\Tests\Service\PriceCalculator;

use App\Const\CouponTypeEnum;
use App\Entity\CountryTax;
use App\Entity\Coupon;
use PHPUnit\Framework\TestCase;
use App\Service\PriceCalculator\PriceCalculatorService;
use App\Service\PriceCalculator\CouponPriceCalculationCommand;
use App\Service\PriceCalculator\CountryTaxPriceCalculationCommand;

class PriceCalculatorServiceTest extends TestCase
{
    public function testNoCommands(): void
    {
        $priceCalculator = new PriceCalculatorService();

        $this->assertSame(100., $priceCalculator->calculate(100));
    }

    public function testWithCommands(): void
    {
        $countryTax = new CountryTax();
        $countryTax->setValue(10);
        $taxCalculatorCommand = new CountryTaxPriceCalculationCommand($countryTax);

        $fixedCoupon = new Coupon();
        $fixedCoupon->setType(CouponTypeEnum::Fixed->value);
        $fixedCoupon->setValue(50);
        $couponCalculatorCommand = new CouponPriceCalculationCommand($fixedCoupon);

        $priceCalculator = new PriceCalculatorService();
        $priceCalculator->addPriceCalculationCommand($couponCalculatorCommand);
        $priceCalculator->addPriceCalculationCommand($taxCalculatorCommand);

        $this->assertSame(55., $priceCalculator->calculate(100));

        $priceCalculator = new PriceCalculatorService();
        $priceCalculator->addPriceCalculationCommand($taxCalculatorCommand);
        $priceCalculator->addPriceCalculationCommand($couponCalculatorCommand);

        $this->assertSame(60., $priceCalculator->calculate(100));
    }
}
