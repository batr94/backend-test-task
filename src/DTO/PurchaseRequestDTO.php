<?php

declare(strict_types=1);

namespace App\DTO;

use App\Validator\TaxNumber;
use App\Validator\CouponCode;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class PurchaseRequestDTO
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Type('integer')]
        public ?int $product,

        #[Assert\NotBlank]
        #[Assert\Type('string')]
        #[TaxNumber]
        public ?string $taxNumber,

        #[Assert\Type('string')]
        #[CouponCode]
        public ?string $couponCode,

        #[Assert\NotBlank]
        #[Assert\Type('string')]
        public ?string $paymentProcessor
    ) {
    }
}