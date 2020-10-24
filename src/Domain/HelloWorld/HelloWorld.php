<?php

declare(strict_types=1);

namespace App\Domain\HelloWorld;

use App\Domain\HelloWorld\Event\HelloWorldCreated;
use App\Domain\Shared\AggregateRoot;

class HelloWorld extends AggregateRoot
{
    private Greeting $greeting;
    private Status $status;

    public function __construct(Greeting $greeting)
    {
        $this->greeting = $greeting;
        $this->status = Status::CREATED();
        $this->record(new HelloWorldCreated($greeting));
    }

    public function deliver(): void
    {
        $this->status = Status::DELIVERED();
    }

    public function getGreeting(): Greeting
    {
        return $this->greeting;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }
}
