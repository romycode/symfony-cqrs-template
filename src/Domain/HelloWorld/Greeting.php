<?php

declare(strict_types=1);

namespace App\Domain\HelloWorld;

use App\Domain\HelloWorld\Exception\EmptyGreetingMessageException;

class Greeting
{
    private string $message;

    public function __construct(string $message)
    {
        if (empty($message)) {
            throw new EmptyGreetingMessageException();
        }

        $this->message = $message;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function equals(Greeting $toCompare): bool
    {
        return
            $this->message === $toCompare->getMessage()
        ;
    }
}
