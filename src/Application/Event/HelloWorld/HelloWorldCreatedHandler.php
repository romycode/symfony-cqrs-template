<?php

declare(strict_types=1);

namespace App\Application\Event\HelloWorld;

use App\Application\Event\EventBusHandler;
use App\Domain\HelloWorld\Event\HelloWorldCreated;

class HelloWorldCreatedHandler implements EventBusHandler
{
    public function __invoke(HelloWorldCreated $event): void
    {
        // TODO: Send an email to PO, for example
    }
}
