<?php

declare(strict_types=1);

namespace App\EventListener;

use App\Exception\NotFoundException;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

#[AsEventListener]
final class NotFoundExceptionListener
{
    public function __invoke(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if (!$exception instanceof NotFoundException) {
            return;
        }

        $result = [
            'error' => $exception->getMessage(),
        ];

        $event->setResponse(new JsonResponse($result, $exception->getCode()));
    }
}