<?php

declare(strict_types=1);

namespace App\Application\Command\HelloWorld;

use App\Application\Command\Command;
use App\Application\Command\InvalidCommandException;

class CreateHelloWorldCommand extends Command
{
    private string $greetingMessage;

    public function __construct(string $greetingMessage)
    {
        if (empty($greetingMessage)) {
            throw new InvalidCommandException('Greeting must not be empty');
        }

        $this->greetingMessage = $greetingMessage;
    }

    public function getGreetingMessage(): string
    {
        return $this->greetingMessage;
    }

    public function getCommandName(): string
    {
        return 'hello_world.create';
    }
}
