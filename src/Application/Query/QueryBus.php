<?php

declare(strict_types=1);

namespace App\Application\Query;

interface QueryBus
{
    /** @return mixed */
    public function ask(Query $query);
}
