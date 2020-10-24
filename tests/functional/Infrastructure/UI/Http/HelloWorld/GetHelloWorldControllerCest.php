<?php

declare(strict_types=1);

namespace Tests\functional\Infrastructure\UI\Http\HelloWorld;

use Codeception\Util\HttpCode;
use Tests\FunctionalTester;

class GetHelloWorldControllerCest
{
    private const ENDPOINT_URL = '/hello-world/%s';

    public function itShouldGetAHelloWorld(FunctionalTester $I)
    {
        $I->wantTo('Given a greet message when HelloWorld exists then returns it');
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendGET(sprintf(self::ENDPOINT_URL, 'test'));
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'greet' => 'string',
            'status' => 'string',
        ]);
    }
}
