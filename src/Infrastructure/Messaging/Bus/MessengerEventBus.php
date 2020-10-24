<?php

declare(strict_types=1);

namespace App\Infrastructure\Messaging\Bus;

use App\Application\Event\EventBus;
use App\Domain\Shared\Event\DomainEvent;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;

class MessengerEventBus implements EventBus
{
    private MessageBusInterface $eventBus;

    public function __construct(MessageBusInterface $eventBus)
    {
        $this->eventBus = $eventBus;
    }

    public function publish(DomainEvent ...$domainEvents): void
    {
        foreach ($domainEvents as $event) {
            $this->eventBus->dispatch(new Envelope($event));
        }
    }
}
