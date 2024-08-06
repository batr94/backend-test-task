<?php

declare(strict_types=1);

namespace App\Validator;

use App\Repository\CountryTaxRepository;
use App\Service\ParseCountryTaxSerialNumber;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

final class TaxNumberValidator extends ConstraintValidator
{
    public function __construct(
        private readonly CountryTaxRepository $countryTaxRepository
    ) {
    }

    public function validate(mixed $value, Constraint $constraint)
    {
        $countryTaxPattern = ParseCountryTaxSerialNumber::parse($value);
        $countryTax = $this->countryTaxRepository->findOneByPattern($countryTaxPattern);

        if ($countryTax) {
            return;
        }

        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ taxNumber }}', $value)
            ->addViolation();
    }
}