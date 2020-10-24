<?php

declare(strict_types=1);

namespace App\Domain\Shared\Event;

abstract class DomainEvent
{
    abstract public function getEventName(): string;
}
