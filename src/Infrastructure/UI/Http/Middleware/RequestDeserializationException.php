<?php

declare(strict_types=1);

namespace App\Infrastructure\UI\Http\Middleware;

use App\Domain\Shared\Exception\Exception;

class RequestDeserializationException extends Exception
{
}
