<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\InMemory;

use App\Domain\HelloWorld\Greeting;
use App\Domain\HelloWorld\HelloWorld;
use App\Domain\HelloWorld\ReadHelloWorldRepository;

class InMemoryReadHelloWorldRepository implements ReadHelloWorldRepository
{
    private InMemoryDB $db;

    public function __construct(InMemoryDB $db)
    {
        $this->db = $db;
    }

    public function findByGreeting(Greeting $greeting): ?HelloWorld
    {
        /** @var HelloWorld $item */
        foreach ($this->db->getElements() as $item) {
            if ($item->getGreeting()->equals($greeting)) {
                return $item;
            }
        }

        return null;
    }
}
