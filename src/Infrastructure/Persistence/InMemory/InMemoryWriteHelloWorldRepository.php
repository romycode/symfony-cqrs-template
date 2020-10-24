<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\InMemory;

use App\Domain\HelloWorld\HelloWorld;
use App\Domain\HelloWorld\WriteHelloWorldRepository;

class InMemoryWriteHelloWorldRepository implements WriteHelloWorldRepository
{
    private array $items;

    public function __construct()
    {
        $this->items = [];
    }

    public function save(HelloWorld $helloWorld): void
    {
        $this->items[] = $helloWorld;
    }
}
