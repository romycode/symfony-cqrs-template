<?php

declare(strict_types=1);

namespace App\Application\Query;

abstract class Query
{
    abstract public function getQueryName(): string;
}
