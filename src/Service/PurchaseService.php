<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\CalculatePriceDTO;
use App\DTO\PurchaseRequestDTO;
use App\Exception\CountryTaxNotFoundException;
use App\Exception\CouponNotFoundException;
use App\Exception\PaymentException;
use App\Exception\PaymentProcessorNotFoundException;
use App\Exception\ProductNotFoundException;
use App\Service\PaymentProcessor\PaymentProcessorProvider;

final readonly class PurchaseService
{
    public function __construct(
        private PaymentProcessorProvider $paymentProcessorProvider,
        private CalculateProductPriceService $calculateProductPriceService
    ) {
    }

    /**
     * @throws CountryTaxNotFoundException
     * @throws CouponNotFoundException
     * @throws PaymentException
     * @throws PaymentProcessorNotFoundException
     * @throws ProductNotFoundException
     */
    public function purchase(PurchaseRequestDTO $purchaseRequestDTO): void
    {
        $finalPrice = $this->calculateProductPriceService->calculate(
            new CalculatePriceDTO(
                $purchaseRequestDTO->product,
                $purchaseRequestDTO->taxNumber,
                $purchaseRequestDTO->couponCode,
            )
        );

        $paymentProcessor = $this->paymentProcessorProvider->get($purchaseRequestDTO->paymentProcessor);
        $paymentProcessor->pay($finalPrice);
    }
}