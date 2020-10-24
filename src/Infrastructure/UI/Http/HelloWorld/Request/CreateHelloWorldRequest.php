<?php

declare(strict_types=1);

namespace App\Infrastructure\UI\Http\HelloWorld\Request;

use App\Infrastructure\UI\Http\HttpRequest;

class CreateHelloWorldRequest implements HttpRequest
{
    private string $greeting;

    public function __construct(string $greeting)
    {
        $this->greeting = $greeting;
    }

    public function getGreeting(): string
    {
        return $this->greeting;
    }
}
