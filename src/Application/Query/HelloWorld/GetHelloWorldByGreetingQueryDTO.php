<?php

declare(strict_types=1);

namespace App\Application\Query\HelloWorld;

use App\Domain\Shared\ArrayRepresentable;

class GetHelloWorldByGreetingQueryDTO implements ArrayRepresentable
{
    private string $greet;
    private string $status;

    public function __construct(string $greet, string $status)
    {
        $this->greet = $greet;
        $this->status = $status;
    }

    public function getGreet(): string
    {
        return $this->greet;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function toArray(): array
    {
        return [
            'greet' => $this->greet,
            'status' => $this->status,
        ];
    }
}
