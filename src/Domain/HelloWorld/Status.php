<?php

declare(strict_types=1);

namespace App\Domain\HelloWorld;

use App\Domain\Shared\Enum;

/**
 * @method static Status CREATED()
 * @method static Status DELIVERED()
 */
class Status extends Enum
{
    private const CREATED = 'CREATED';
    private const DELIVERED = 'DELIVERED';
}
