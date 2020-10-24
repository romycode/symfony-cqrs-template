<?php

declare(strict_types=1);

namespace App\Application\Query;

use App\Domain\Shared\Exception\Exception;

class InvalidQueryException extends Exception
{
    public function __construct(string $errorMessage)
    {
        parent::__construct($errorMessage);
    }
}
