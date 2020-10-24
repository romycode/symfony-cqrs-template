<?php

declare(strict_types=1);

namespace App\Domain\Shared;

interface ArrayRepresentable
{
    public function toArray(): array;
}
