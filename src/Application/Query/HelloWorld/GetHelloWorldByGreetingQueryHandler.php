<?php

declare(strict_types=1);

namespace App\Application\Query\HelloWorld;

use App\Application\Query\QueryBusHandler;
use App\Domain\HelloWorld\Greeting;
use App\Domain\HelloWorld\ReadHelloWorldRepository;

class GetHelloWorldByGreetingQueryHandler implements QueryBusHandler
{
    private ReadHelloWorldRepository $repository;

    public function __construct(ReadHelloWorldRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(GetHelloWorldByGreetingQuery $query): GetHelloWorldByGreetingQueryDTO
    {
        $helloWorld = $this->repository->findByGreeting(
            new Greeting($query->getGreeting())
        );

        return new GetHelloWorldByGreetingQueryDTO(
            $helloWorld->getGreeting()->getMessage(),
            $helloWorld->getStatus()->getValue()
        );
    }
}
