<?php

declare(strict_types=1);

namespace App\Service\PaymentProcessor;

use App\Const\PaymentServiceEnum;
use App\Exception\PaymentException;

interface PaymentProcessorDecoratorInterface
{
    public function getServiceName(): string;

    /**
     * @throws PaymentException
     */
    public function pay(float $amount): void;
}