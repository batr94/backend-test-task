<?php

declare(strict_types=1);

namespace App\DTO;

use App\Const\PaymentServiceEnum;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class PurchaseRequestDTO
{
    public function __construct(
        #[Assert\Type('integer'), Assert\NotNull]
        public ?int $product,
        #[Assert\Type('string'), Assert\NotNull]
        public ?string $taxNumber,
        #[Assert\Type('string')]
        public ?string $couponCode,
        #[Assert\Type(type: PaymentServiceEnum::class)]
        public ?PaymentServiceEnum $paymentProcessor
    ) {
    }
}