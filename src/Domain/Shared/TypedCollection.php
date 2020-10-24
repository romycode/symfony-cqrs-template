<?php

declare(strict_types=1);

namespace App\Domain\Shared;

use ArrayIterator;
use Countable;
use InvalidArgumentException;
use IteratorAggregate;

abstract class TypedCollection implements Countable, IteratorAggregate
{
    private array $items;

    public function __construct(array $items)
    {
        $this->checkTypesOrThrow($items);
        $this->items = $items;
    }

    abstract public function getType(): string;

    public function getIterator()
    {
        return new ArrayIterator($this->items);
    }

    public function isEmpty(): bool
    {
        return 0 === $this->count();
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function sort(callable $compareFunction): void
    {
        usort($this->items, $compareFunction);
    }

    /** @param mixed $value */
    public function has($value): bool
    {
        $type = $this->getType();

        if (!$value instanceof $type) {
            throw new InvalidArgumentException();
        }

        return in_array($value, $this->items);
    }

    public function toArray(): array
    {
        $output = [];
        array_map(
            function (ArrayRepresentable $value) use (&$output) {
                $output[] = $value->toArray();

                return $output;
            },
            $this->items
        );

        return $output;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    private function checkTypesOrThrow(array $items): void
    {
        foreach ($items as $item) {
            $className = get_class($item);

            if ($this->getType() !== $className) {
                throw new InvalidArgumentException(sprintf('The class "%s" is not a valid type of "%s"', $className, $this->getType()));
            }
        }
    }
}
