<?php

declare(strict_types=1);

namespace App\Exception;

use Symfony\Component\HttpFoundation\Response;

final class PaymentProcessorNotFoundException extends NotFoundException
{
    public function __construct(string $name, ?int $code = Response::HTTP_NOT_FOUND)
    {
        parent::__construct(sprintf('Payment processor with name "%s" could not found', $name), $code);
    }
}