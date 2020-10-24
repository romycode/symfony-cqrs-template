<?php

declare(strict_types=1);

namespace App\Infrastructure\UI\Http\Middleware;

use App\Application\Command\InvalidCommandException;
use App\Application\Query\InvalidQueryException;
use App\Domain\Shared\Exception\NotFoundException;
use App\Infrastructure\UI\Http\Middleware\Validator\RequestValidationException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Throwable;

class ExceptionMiddleware implements EventSubscriberInterface
{
    public function onKernelError(ExceptionEvent $event)
    {
        if (false === $event->isMasterRequest()) {
            return;
        }

        $exception = $event->getThrowable();

        if ($this->isSymfonyMessengerException($exception)) {
            $exception = $exception->getPrevious();
        }

        switch (true) {
            case $exception instanceof RequestDeserializationException:
                $event->setResponse(
                    new JsonResponse($exception->getMessage(), Response::HTTP_BAD_REQUEST)
                );
                break;

            case $exception instanceof RequestValidationException:
                $event->setResponse(
                    new JsonResponse($exception->getErrors(), Response::HTTP_CONFLICT)
                );
                break;

            case $this->isApplicationException($exception):
                $event->setResponse(
                    new JsonResponse($exception->getMessage(), Response::HTTP_BAD_REQUEST)
                );
                break;

            case $exception instanceof NotFoundException:
                $event->setResponse(
                    new JsonResponse('', Response::HTTP_NOT_FOUND)
                );
                break;

            default:
                $event->setResponse(
                    new JsonResponse('Internal server error', Response::HTTP_INTERNAL_SERVER_ERROR)
                );
        }
    }

    private function isApplicationException(Throwable $exception): bool
    {
        return
            $exception instanceof InvalidQueryException ||
            $exception instanceof InvalidCommandException
        ;
    }

    private function isSymfonyMessengerException(Throwable $exception): bool
    {
        return $exception instanceof HandlerFailedException;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::EXCEPTION => 'onKernelError',
        ];
    }
}
