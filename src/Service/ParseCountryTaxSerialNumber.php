<?php

declare(strict_types=1);

namespace App\Service;

final class ParseCountryTaxSerialNumber
{
    private const int CODE_PART_LENGTH = 2;

    private const string NUMBER_REPLACEMENT = 'X';

    private const string CHAR_REPLACEMENT = 'Y';

    public static function parse(string $serialNumber): string
    {
        $codePart = substr($serialNumber, 0, self::CODE_PART_LENGTH);
        $serialNumberPart = preg_replace(
            ['/[a-zA-Z]/', '/[0-9]/'],
            [self::CHAR_REPLACEMENT, self::NUMBER_REPLACEMENT],
            substr($serialNumber, self::CODE_PART_LENGTH),
        );

        return $codePart . $serialNumberPart;
    }
}