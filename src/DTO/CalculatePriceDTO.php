<?php

declare(strict_types=1);

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class CalculatePriceDTO
{
    public function __construct(
        #[Assert\Type('integer'), Assert\NotNull]
        public ?int $product,
        #[Assert\Type('string'), Assert\NotNull]
        public ?string $taxNumber,
        #[Assert\Type('string')]
        public ?string $couponCode
    ) {
    }
}