<?php

declare(strict_types=1);

namespace App\Exception;

use Symfony\Component\HttpFoundation\Response;

class NotFoundException extends \Exception
{
    public function __construct(string $message, ?int $code = Response::HTTP_NOT_FOUND)
    {
        parent::__construct($message, $code);
    }
}