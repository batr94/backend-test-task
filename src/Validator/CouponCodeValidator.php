<?php

declare(strict_types=1);

namespace App\Validator;

use App\Repository\CouponRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

final class CouponCodeValidator extends ConstraintValidator
{
    public function __construct(
        private readonly CouponRepository $couponRepository
    ) {
    }

    public function validate(mixed $value, Constraint $constraint)
    {
        $coupon = $this->couponRepository->findOneByName($value);

        if ($coupon) {
            return;
        }

        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ couponCode }}', $value)
            ->addViolation();
    }
}