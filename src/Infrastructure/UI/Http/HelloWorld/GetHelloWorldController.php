<?php

declare(strict_types=1);

namespace App\Infrastructure\UI\Http\HelloWorld;

use App\Application\Query\HelloWorld\GetHelloWorldByGreetingQuery;
use App\Application\Query\QueryBus;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetHelloWorldController
{
    private QueryBus $queryBus;

    public function __construct(QueryBus $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    public function execute(string $greet): JsonResponse
    {
        $helloWorldDTO = $this->queryBus->ask(
            new GetHelloWorldByGreetingQuery($greet)
        );
        
        return new JsonResponse($helloWorldDTO->toArray(), 200);
    }
}
