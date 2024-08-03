<?php

declare(strict_types=1);

namespace App\Const;

enum PaymentServiceEnum: string
{
    case Paypal = 'paypal';

    case Stripe = 'stripe';
}
