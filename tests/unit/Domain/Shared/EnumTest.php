<?php

declare(strict_types=1);

namespace Tests\unit\Domain\Shared;

use App\Domain\Shared\Enum;
use PHPUnit\Framework\TestCase;
use UnexpectedValueException;

class EnumTest extends TestCase
{
    public function testCreateAvailableValue()
    {
        $this->assertSame('one', $this->createTestEnum('one')->getValue());
    }

    public function testCreateUnavailableValueThrowsException()
    {
        $this->expectException(UnexpectedValueException::class);
        $this->createTestEnum('unavailable value');
    }

    public function testEquals()
    {
        $this->assertTrue(
            $this->createTestEnum('one')->equals($this->createTestEnum('one'))
        );
    }

    public function testToString()
    {
        $this->assertSame('one', $this->createTestEnum('one')->__toString());
    }

    public function testToArray()
    {
        $enum = $this->createTestEnum('one');
        $this->assertSame(['ONE' => 'one'], $enum::toArray());
    }

    private function createTestEnum($value): Enum
    {
        return new class($value) extends Enum {
            private const ONE = 'one';
        };
    }
}
