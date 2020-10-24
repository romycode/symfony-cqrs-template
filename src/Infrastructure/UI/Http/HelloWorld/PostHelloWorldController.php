<?php

declare(strict_types=1);

namespace App\Infrastructure\UI\Http\HelloWorld;

use App\Application\Command\CommandBus;
use App\Application\Command\HelloWorld\CreateHelloWorldCommand;
use App\Infrastructure\UI\Http\HelloWorld\Request\CreateHelloWorldRequest;
use App\Infrastructure\UI\Http\Middleware\RequestDeserializer;
use App\Infrastructure\UI\Http\Middleware\Validator\RequestValidator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PostHelloWorldController
{
    private RequestValidator $validator;
    private RequestDeserializer $serializer;
    private CommandBus $commandBus;

    public function __construct(RequestValidator $validator, RequestDeserializer $serializer, CommandBus $commandBus)
    {
        $this->validator = $validator;
        $this->serializer = $serializer;
        $this->commandBus = $commandBus;
    }

    public function execute(Request $request): JsonResponse
    {
        /** @var CreateHelloWorldRequest $createHelloWorldRequest */
        $createHelloWorldRequest = $this->serializer->deserialize($request, CreateHelloWorldRequest::class);
        $this->validator->validate($createHelloWorldRequest);
        $this->commandBus->dispatch(new CreateHelloWorldCommand(
            $createHelloWorldRequest->getGreeting()
        ));

        return new JsonResponse(null, Response::HTTP_CREATED);
    }
}
