<?php

declare(strict_types=1);

namespace App\Domain\HelloWorld\Event;

use App\Domain\HelloWorld\Greeting;
use App\Domain\Shared\Event\DomainEvent;

class HelloWorldCreated extends DomainEvent
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

    public function getEventName(): string
    {
        return 'hello_world.created';
    }
}
