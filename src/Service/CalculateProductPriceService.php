<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\CalculatePriceDTO;
use App\Repository\CountryTaxRepository;
use App\Repository\CouponRepository;
use App\Repository\ProductRepository;
use App\Service\PriceCalculator\CountryTaxPriceCalculationCommand;
use App\Service\PriceCalculator\CouponPriceCalculationCommand;
use App\Service\PriceCalculator\PriceCalculatorService;

final readonly class CalculateProductPriceService
{
    public function __construct(
        private ProductRepository $productRepository,
        private CountryTaxRepository $countryTaxRepository,
        private CouponRepository $couponRepository
    ) {
    }

    public function calculate(CalculatePriceDTO $calculatePriceDTO): float
    {
        $product = $this->productRepository->getProduct($calculatePriceDTO->product);
        $countryTax = $this->countryTaxRepository->getOneByPattern(
            ParseCountryTaxSerialNumber::parse($calculatePriceDTO->taxNumber)
        );
        $priceCalculator = new PriceCalculatorService();

        if ($calculatePriceDTO->couponCode !== null) {
            $coupon = $this->couponRepository->getByName($calculatePriceDTO->couponCode);
            $priceCalculator->addPriceCalculationCommand(new CouponPriceCalculationCommand($coupon));
        }

        $priceCalculator->addPriceCalculationCommand(new CountryTaxPriceCalculationCommand($countryTax));

        return $priceCalculator->calculate($product->getProductPrices()->last()->getPrice());
    }
}