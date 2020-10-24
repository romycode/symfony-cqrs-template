<?php

declare(strict_types=1);

namespace Tests\unit\ObjectMother;

use App\Domain\HelloWorld\HelloWorld;

class HelloWorldMother
{
    public static function random(): HelloWorld
    {
        return new HelloWorld(
            GreetingMother::random()
        );
    }
}
