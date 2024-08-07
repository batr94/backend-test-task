<?php

declare(strict_types=1);

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\TaxNumber;
use App\Validator\CouponCode;

final readonly class CalculatePriceDTO
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
        public ?string $couponCode
    ) {
    }
}