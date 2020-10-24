<?php

declare(strict_types=1);

namespace Tests\unit\ObjectMother;

use App\Domain\HelloWorld\Greeting;
use Faker\Factory;

class GreetingMother
{
    public static function random(): Greeting
    {
        $faker = Factory::create();

        return new Greeting(
            $faker->lexify('??????')
        );
    }
}
