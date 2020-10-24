<?php

declare(strict_types=1);

namespace App\Application\Event;

use App\Domain\Shared\Event\DomainEvent;

interface EventBus
{
    public function publish(DomainEvent ...$domainEvents): void;
}
