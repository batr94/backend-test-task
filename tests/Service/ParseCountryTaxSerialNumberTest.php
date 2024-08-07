<?php

namespace App\Tests\Service;

use PHPUnit\Framework\TestCase;
use App\Service\ParseCountryTaxSerialNumber;

class ParseCountryTaxSerialNumberTest extends TestCase
{
    public function testCountryTaxParseService(): void
    {
        $this->assertSame(
            'DEXXXXXXXXX',
            ParseCountryTaxSerialNumber::parse('DE123456789')
        );

        $this->assertSame(
            'ITYYXXXXXXX',
            ParseCountryTaxSerialNumber::parse('ITAL7654321')
        );

        $this->assertNotSame(
            'FRYYXXXXXXX',
            ParseCountryTaxSerialNumber::parse('FR987654321')
        );
    }
}
