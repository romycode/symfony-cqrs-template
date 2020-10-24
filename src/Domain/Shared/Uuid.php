<?php

declare(strict_types=1);

namespace App\Domain\Shared;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid as RamseyUuid;

class Uuid
{
    private string $value;

    final public function __construct(string $value)
    {
        $this->isUuidOrThrow($value);
        $this->value = $value;
    }

    public static function random(): self
    {
        return new static(RamseyUuid::uuid4()->toString());
    }

    public function equals(Uuid $id): bool
    {
        return $this->value === $id->getValue();
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->getValue();
    }

    private function isUuidOrThrow(string $uuid): void
    {
        if (false === RamseyUuid::isValid($uuid)) {
            throw new InvalidArgumentException(sprintf('The value "%s" is not a valid UUID4', $uuid));
        }
    }
}
