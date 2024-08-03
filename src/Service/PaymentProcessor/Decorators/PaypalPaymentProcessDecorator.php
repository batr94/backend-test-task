<?php

declare(strict_types=1);

namespace App\Service\PaymentProcessor\Decorators;

use App\Const\PaymentServiceEnum;
use App\Exception\PaymentException;
use App\Service\PaymentProcessor\PaymentProcessorDecoratorInterface;
use Systemeio\TestForCandidates\PaymentProcessor\PaypalPaymentProcessor;

final readonly class PaypalPaymentProcessDecorator implements PaymentProcessorDecoratorInterface
{
    public function __construct(
        private PaypalPaymentProcessor $paymentProcessor
    ) {
    }

    public function getServiceName(): PaymentServiceEnum
    {
        return PaymentServiceEnum::Paypal;
    }

    public function pay(float $amount): void
    {
        try {
            $this->paymentProcessor->pay((int) $amount);
        } catch (\Exception $exception) {
            throw new PaymentException($exception->getMessage());
        }
    }
}