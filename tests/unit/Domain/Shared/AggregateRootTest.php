<?php

declare(strict_types=1);

namespace Tests\unit\Domain\Shared;

use App\Domain\Shared\AggregateRoot;
use App\Domain\Shared\Event\DomainEvent;
use PHPUnit\Framework\TestCase;

class AggregateRootTest extends TestCase
{
    public function testRecordEvent()
    {
        $aggregate = $this->createTestAggregateRoot();
        $aggregate->doSomething();
        $domainEvents = $aggregate->pullDomainEvents();

        $this->assertCount(1, $domainEvents);
        $this->assertInstanceOf(DomainEvent::class, $domainEvents[0]);
    }

    private function createTestAggregateRoot(): AggregateRoot
    {
        $domainEvent = $this->createTestDomainEvent();

        return new class($domainEvent) extends AggregateRoot {
            private DomainEvent $domainEvent;

            public function __construct(DomainEvent $domainEvent)
            {
                $this->domainEvent = $domainEvent;
            }

            public function doSomething(): void
            {
                $this->record($this->domainEvent);
            }
        };
    }

    private function createTestDomainEvent(): DomainEvent
    {
        return new class() extends DomainEvent {
            public function getEventName(): string
            {
                return 'test.event';
            }
        };
    }
}
