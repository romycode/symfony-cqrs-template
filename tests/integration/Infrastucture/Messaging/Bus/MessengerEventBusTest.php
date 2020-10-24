<?php

declare(strict_types=1);

namespace Tests\integration\Infrastucture\Messaging\Bus;

use App\Domain\HelloWorld\Event\HelloWorldCreated;
use App\Infrastructure\Messaging\Bus\MessengerEventBus;
use Tests\integration\IntegrationTestCase;
use Tests\unit\ObjectMother\GreetingMother;

class MessengerEventBusTest extends IntegrationTestCase
{
    /** @var object|MessengerEventBus|null */
    private $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = self::$container->get(MessengerEventBus::class);
    }

    /** @doesNotPerformAssertions */
    public function testDispatchHelloWorldCreatedEvent()
    {
        $this->sut->publish(new HelloWorldCreated(GreetingMother::random()));
    }
}
