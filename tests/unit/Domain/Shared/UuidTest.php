<?php

declare(strict_types=1);

namespace Tests\unit\Domain\Shared;

use App\Domain\Shared\Uuid;
use PHPUnit\Framework\TestCase;

class UuidTest extends TestCase
{
    private const UUID = '070a0b9d-7cbc-473a-b95c-77a156c1177a';

    public function testCreateUuid()
    {
        $this->assertSame(self::UUID, (new Uuid(self::UUID))->getValue());
    }

    public function testRandom()
    {
        $this->assertNotSame(self::UUID, Uuid::random());
    }

    public function testEquals()
    {
        $this->assertTrue(
            (new Uuid(self::UUID))->equals(
                new Uuid(self::UUID)
            )
        );
    }
}
