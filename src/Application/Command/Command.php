<?php

declare(strict_types=1);

namespace App\Application\Command;

abstract class Command
{
    abstract public function getCommandName(): string;
}
