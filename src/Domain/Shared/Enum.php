<?php

declare(strict_types=1);

namespace App\Domain\Shared;

use BadMethodCallException;
use ReflectionClass;
use UnexpectedValueException;

class Enum
{
    /** @var mixed */
    protected $value;
    protected static array $cache = [];

    /** @param mixed $value */
    final public function __construct($value)
    {
        if ($value instanceof static) {
            $value = $value->getValue();
        }

        if (false === $this->isValid($value)) {
            throw new UnexpectedValueException(sprintf('Value "%s" is not part of the enum "%s"', strval($value), static::class));
        }

        $this->value = $value;
    }

    /** @return mixed */
    public function getValue()
    {
        return $this->value;
    }

    public static function toArray(): array
    {
        self::saveConstantsInCacheIfNeeded();

        return static::$cache[static::class];
    }

    /** @param mixed|null $variable */
    final public function equals($variable = null): bool
    {
        return $variable instanceof self
            && $this->getValue() === $variable->getValue()
            && static::class === get_class($variable);
    }

    /**
     * @param string $name
     * @param mixed  $arguments
     *
     * @return static
     */
    public static function __callStatic($name, $arguments)
    {
        $array = static::toArray();
        if (true === isset($array[$name]) || array_key_exists($name, $array)) {
            return new static($array[$name]);
        }

        throw new BadMethodCallException(sprintf('No static method or enum constant "%s" in class "%s"', $name, static::class));
    }

    public function __toString()
    {
        return strval($this->value);
    }

    /** @param mixed $value */
    private static function isValid($value): bool
    {
        return in_array($value, static::toArray(), true);
    }

    private static function saveConstantsInCacheIfNeeded(): void
    {
        if (false === isset(static::$cache[static::class])) {
            $reflection = new ReflectionClass(static::class);
            static::$cache[static::class] = $reflection->getConstants();
        }
    }
}
