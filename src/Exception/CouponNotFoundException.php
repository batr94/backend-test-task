<?php

declare(strict_types=1);

namespace App\Exception;

final class CouponNotFoundException extends NotFoundException
{
    public function __construct(string $name)
    {
        parent::__construct(sprintf('The coupon "%s" could not be found', $name));
    }
}