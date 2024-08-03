<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\CalculatePriceDTO;
use App\DTO\PurchaseRequestDTO;
use App\Service\PaymentProcessor\PaymentProcessorProvider;

final readonly class PurchaseService
{
    public function __construct(
        private PaymentProcessorProvider $paymentProcessorProvider,
        private CalculateProductPriceService $calculateProductPriceService
    ) {
    }

    public function purchase(PurchaseRequestDTO $purchaseRequestDTO)
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