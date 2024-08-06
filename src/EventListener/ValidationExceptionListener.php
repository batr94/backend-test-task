<?php

declare(strict_types=1);

namespace App\EventListener;

use App\Exception\NotFoundException;
use App\Exception\PaymentException;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Validator\Exception\ValidationFailedException;

#[AsEventListener]
final class ValidationExceptionListener
{
    public function __invoke(ExceptionEvent $event): void
    {
        if (!$event->getThrowable()->getPrevious() instanceof ValidationFailedException) {
            return;
        }

        /** @var ValidationFailedException $exception */
        $exception = $event->getThrowable()->getPrevious();
        $errors = [];

        foreach ($exception->getViolations() as $item) {
            $errors[$item->getPropertyPath()] = $item->getMessage();
        }

        $result = [
            'message' => 'Validation error',
            'errors' => $errors,
        ];

        $event->setResponse(new JsonResponse($result, Response::HTTP_BAD_REQUEST));
    }
}