<?php

declare(strict_types=1);

namespace App\Infrastructure\Messaging\Bus;

use App\Application\Query\Query;
use App\Application\Query\QueryBus;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

class MessengerQueryBus implements QueryBus
{
    private MessageBusInterface $queryBus;

    public function __construct(MessageBusInterface $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    public function ask(Query $query)
    {
        $envelope = $this->queryBus->dispatch(new Envelope($query));
        /** @var HandledStamp $handledStamp */
        $handledStamp = $envelope->last(HandledStamp::class);

        return $handledStamp->getResult();
    }
}
