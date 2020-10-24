<?php

declare(strict_types=1);

namespace Tests\unit\Domain\Shared;

use App\Domain\Shared\TypedCollection;
use DateTimeImmutable;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use stdClass;

class TypedCollectionTest extends TestCase
{
    public function testForEach()
    {
        $typedCollection = $this->createStdClassCollection([
            new stdClass(),
            new stdClass(),
        ]);

        foreach ($typedCollection as $item) {
            $this->assertInstanceOf(stdClass::class, $item);
        }
    }

    public function testCount()
    {
        $this->assertCount(2, $this->createStdClassCollection([
            new stdClass(),
            new stdClass(),
        ]));
    }

    public function testSort()
    {
        $c1 = new stdClass();
        $c1->value = 1;
        $c2 = new stdClass();
        $c2->value = 3;
        $c3 = new stdClass();
        $c3->value = 2;

        $collection = $this->createStdClassCollection([
            $c1,
            $c2,
            $c3,
        ]);

        $collection->sort(function ($v1, $v2) {
            return $v1 > $v2;
        });

        $this->assertEquals([$c1, $c3, $c2], $collection->getItems());
    }

    public function testHas()
    {
        $c1 = new stdClass();
        $c1->prop = 'a';
        $c2 = new stdClass();
        $c2->prop = 'b';
        $collection = $this->createStdClassCollection([$c1]);

        $this->assertTrue($collection->has($c1));
        $this->assertFalse($collection->has($c2));
    }

    public function testIsEmpty()
    {
        $collection = new class([]) extends TypedCollection {
            public function getType(): string
            {
                return stdClass::class;
            }
        };

        $this->assertTrue($collection->isEmpty());
    }

    public function testCreateUnsupportedTypeThrowsException()
    {
        $this->expectException(InvalidArgumentException::class);
        $values = [new DateTimeImmutable()];

        new class($values) extends TypedCollection {
            public function getType(): string
            {
                return stdClass::class;
            }
        };
    }

    private function createStdClassCollection(array $values): TypedCollection
    {
        return new class($values) extends TypedCollection {
            public function getType(): string
            {
                return stdClass::class;
            }
        };
    }
}
