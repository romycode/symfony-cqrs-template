<?php

declare(strict_types=1);

namespace App\Infrastructure\UI\Http\HealthCheck;

use Symfony\Component\HttpFoundation\Response;

class GetHealthCheckController
{
    public function execute(): Response
    {
        return new Response('¡OK!', 200);
    }
}
