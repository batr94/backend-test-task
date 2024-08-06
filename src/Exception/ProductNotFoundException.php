<?php

declare(strict_types=1);

namespace App\Exception;

use Symfony\Component\HttpFoundation\Response;

final class ProductNotFoundException extends NotFoundException
{
    public function __construct(string $name)
    {
        parent::__construct(sprintf('Payment service "%s" could not be found', $name));
    }
}