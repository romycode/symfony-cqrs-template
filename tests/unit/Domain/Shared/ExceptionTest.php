<?php

declare(strict_types=1);

namespace Tests\unit\Domain\Shared;

use App\Domain\Shared\Exception\Exception;
use PHPUnit\Framework\TestCase;

class ExceptionTest extends TestCase
{
    public function testCreateExceptionHasZeroCode()
    {
        $exception = new Exception('test');

        $this->assertSame(0, $exception->getCode());
    }

    public function testCreateExceptionWithPreviousExceptionContainsIt()
    {
        $previousException = new Exception('previous exception');
        $exception = new Exception('test', $previousException);

        $this->assertSame($previousException, $exception->getPrevious());
    }
}
