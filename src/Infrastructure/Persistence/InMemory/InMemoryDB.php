<?php

declare(strict_types=1);


namespace App\Infrastructure\Persistence\InMemory;


class InMemoryDB
{
    private array $items;

    public function __construct()
    {
        $this->items = [];
    }

    public function add($element): void
    {
        $this->items[] = $element;
    }

    public function getElements(): array
    {
        return $this->items;
    }
}