<?php

declare(strict_types=1);

namespace App\Domain\HelloWorld\Exception;

use App\Domain\Shared\Exception\Exception;

class EmptyGreetingMessageException extends Exception
{
    public function __construct()
    {
        parent::__construct('Empty greeting message');
    }
}
