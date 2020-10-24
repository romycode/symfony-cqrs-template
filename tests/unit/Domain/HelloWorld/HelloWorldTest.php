<?php

declare(strict_types=1);

namespace Tests\unit\Domain\HelloWorld;

use App\Domain\HelloWorld\Event\HelloWorldCreated;
use Tests\unit\ObjectMother\HelloWorldMother;
use Tests\unit\UnitTestCase;

class HelloWorldTest extends UnitTestCase
{
    public function testHelloWorldCreatedEvent()
    {
        $helloWorld = HelloWorldMother::random();
        $this->assertDomainEventIsRecorded($helloWorld, HelloWorldCreated::class);
    }
}
