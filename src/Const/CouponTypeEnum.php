<?php

declare(strict_types=1);

namespace App\Const;

enum CouponTypeEnum: string
{
    case Fixed = 'fixed';
    case Percent = 'percent';
}
