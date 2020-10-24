<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\InMemory;

use App\Domain\HelloWorld\Greeting;
use App\Domain\HelloWorld\HelloWorld;
use App\Domain\HelloWorld\ReadHelloWorldRepository;

class InMemoryReadHelloWorldRepository implements ReadHelloWorldRepository
{
    private array $items;

    public function __construct()
    {
        $this->items = [
            new HelloWorld(new Greeting('test')),
            new HelloWorld(new Greeting('test2')),
            new HelloWorld(new Greeting('test3')),
        ];
    }

    public function findByGreeting(Greeting $greeting): ?HelloWorld
    {
        /** @var HelloWorld $item */
        foreach ($this->items as $item) {
            if ($item->getGreeting()->equals($greeting)) {
                return $item;
            }
        }

        return null;
    }
}
