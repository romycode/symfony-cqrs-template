<?php

declare(strict_types=1);

namespace App\Domain\HelloWorld;

interface WriteHelloWorldRepository
{
    public function save(HelloWorld $helloWorld): void;
}
