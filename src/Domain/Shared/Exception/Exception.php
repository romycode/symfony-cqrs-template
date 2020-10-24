<?php

declare(strict_types=1);

namespace App\Domain\Shared\Exception;

use DomainException;
use Throwable;

class Exception extends DomainException
{
    public function __construct(string $message, ?Throwable $previousException = null)
    {
        parent::__construct($message, 0, $previousException);
    }
}
