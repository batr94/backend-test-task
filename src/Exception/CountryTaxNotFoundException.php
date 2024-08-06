<?php

declare(strict_types=1);

namespace App\Exception;

use Symfony\Component\HttpFoundation\Response;

final class CountryTaxNotFoundException extends NotFoundException
{
    public function __construct()
    {
        parent::__construct('Incorrect country tax serial number', Response::HTTP_BAD_REQUEST);
    }
}