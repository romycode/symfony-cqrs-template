<?php

declare(strict_types=1);

namespace App\Application\Query\HelloWorld;

use App\Application\Query\InvalidQueryException;
use App\Application\Query\Query;

class GetHelloWorldByGreetingQuery extends Query
{
    private string $greeting;

    public function __construct(string $greeting)
    {
        if (empty($greeting)) {
            throw new InvalidQueryException('Greeting must not be empty');
        }

        $this->greeting = $greeting;
    }

    public function getGreeting(): string
    {
        return $this->greeting;
    }

    public function getQueryName(): string
    {
        return 'hello_world.get';
    }
}
