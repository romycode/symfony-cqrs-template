<?php

declare(strict_types=1);

namespace Tests\unit;

use App\Domain\Shared\AggregateRoot;
use PHPUnit\Framework\TestCase;

class UnitTestCase extends TestCase
{
    protected function assertDomainEventIsRecorded(
        AggregateRoot $aggregateRoot,
        string $domainEventClassName
    ): void {
        foreach ($aggregateRoot->pullDomainEvents() as $event) {
            if ($domainEventClassName === get_class($event)) {
                $this->assertInstanceOf($domainEventClassName, $event);
            }
        }
    }
}
