<?php

declare(strict_types=1);

namespace App\Service\PaymentProcessor;

use App\Const\PaymentServiceEnum;
use App\Exception\PaymentProcessorNotFoundException;
use Symfony\Component\DependencyInjection\Attribute\AutowireIterator;

final readonly class PaymentProcessorProvider
{
    public function __construct(
        /** @var iterable<PaymentProcessorDecoratorInterface> */
        #[AutowireIterator('app.payment_processor')]
        private iterable $paymentProcessors
    ) {
    }

    /**
     * @throws PaymentProcessorNotFoundException
     */
    public function get(string $serviceName): PaymentProcessorDecoratorInterface
    {
        foreach ($this->paymentProcessors as $processor) {
            if ($serviceName === $processor->getServiceName()) {
                return $processor;
            }
        }

        throw new PaymentProcessorNotFoundException($serviceName);
    }
}