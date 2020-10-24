<?php

declare(strict_types=1);

namespace App\Infrastructure\Messaging\Bus;

use App\Application\Command\Command;
use App\Application\Command\CommandBus;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;

class MessengerCommandBus implements CommandBus
{
    private MessageBusInterface $commandBus;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function dispatch(Command $command): void
    {
        $this->commandBus->dispatch(new Envelope($command));
    }
}
