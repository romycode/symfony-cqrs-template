<?php

declare(strict_types=1);

namespace App\Application\UseCase\HelloWorld;

use App\Domain\HelloWorld\Greeting;

class CreateHelloWorldUseCaseDTO
{
    private Greeting $greeting;

    public function __construct(Greeting $greeting)
    {
        $this->greeting = $greeting;
    }

    public function getGreeting(): Greeting
    {
        return $this->greeting;
    }
}
