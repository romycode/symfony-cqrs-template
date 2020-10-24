<?php

declare(strict_types=1);

namespace App\Application\Command;

use App\Domain\Shared\Exception\Exception;

class InvalidCommandException extends Exception
{
}
