<?php

declare(strict_types=1);

namespace App\Service\PaymentProcessor\Decorators;

use App\Const\PaymentServiceEnum;
use App\Exception\PaymentException;
use App\Service\PaymentProcessor\PaymentProcessorDecoratorInterface;
use Systemeio\TestForCandidates\PaymentProcessor\StripePaymentProcessor;

final readonly class StripePaymentProcessorDecorator implements PaymentProcessorDecoratorInterface
{
    public function __construct(
        private StripePaymentProcessor $paymentProcessor
    ) {
    }

    public function getServiceName(): PaymentServiceEnum
    {
        return PaymentServiceEnum::Stripe;
    }

    public function pay(float $amount): void
    {
        if ($this->paymentProcessor->processPayment($amount) === false) {
            throw new PaymentException('Error during payment execution');
        }
    }
}