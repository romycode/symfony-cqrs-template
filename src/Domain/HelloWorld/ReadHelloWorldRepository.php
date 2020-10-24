<?php

declare(strict_types=1);

namespace App\Domain\HelloWorld;

interface ReadHelloWorldRepository
{
    public function findByGreeting(Greeting $greeting): ?HelloWorld;
}
