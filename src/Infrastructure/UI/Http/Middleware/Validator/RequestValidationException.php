<?php

declare(strict_types=1);

namespace App\Infrastructure\UI\Http\Middleware\Validator;

use App\Domain\Shared\Exception\Exception;
use Throwable;

class RequestValidationException extends Exception
{
    private array $errors = [];

    public function __construct(array $errors, ?Throwable $previousException = null)
    {
        parent::__construct('Invalid request', $previousException);
        $this->errors = $errors;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
