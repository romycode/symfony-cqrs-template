<?php

declare(strict_types=1);

namespace Tests\functional\Infrastructure\UI\Http\HealthCheck;

use Tests\FunctionalTester;

class GetHealthCheckControllerCest
{
    private const ENDPOINT_URL = '/health';

    public function itShouldReturn200(FunctionalTester $I)
    {
        $I->wantTo('Given a GET request then return 200');
        $I->sendGET(self::ENDPOINT_URL);
        $I->canSeeResponseCodeIs(200);
    }
}
