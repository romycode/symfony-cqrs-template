<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\InMemory;

use App\Domain\HelloWorld\HelloWorld;
use App\Domain\HelloWorld\WriteHelloWorldRepository;

class InMemoryWriteHelloWorldRepository implements WriteHelloWorldRepository
{
    private InMemoryDB $db;

    public function __construct(InMemoryDB $db)
    {
        $this->db = $db;
    }

    public function save(HelloWorld $helloWorld): void
    {
        $this->db->add($helloWorld);
    }
}
