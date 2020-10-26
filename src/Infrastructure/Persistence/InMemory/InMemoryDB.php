<?php

declare(strict_types=1);


namespace App\Infrastructure\Persistence\InMemory;


use App\Domain\HelloWorld\Greeting;
use App\Domain\HelloWorld\HelloWorld;

class InMemoryDB
{
    private array $items;

    public function __construct()
    {
        $this->items = [
            new HelloWorld(
                new Greeting(
                    'test'
                )
            )
        ];
    }

    public function add(HelloWorld $element): void
    {
        $this->items[] = $element;
    }

    public function getElements(): array
    {
        return $this->items;
    }
}