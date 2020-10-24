<?php

declare(strict_types=1);

namespace Tests\functional\Infrastructure\UI\Http\HelloWorld;

use Tests\FunctionalTester;

class PostHelloWorldControllerCest
{
    private const ENDPOINT_URL = '/hello-world';

    public function itShouldCreateAHelloWorld(FunctionalTester $I)
    {
        $I->wantTo('Given a request when is valid then create a HelloWorld and return 201');
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST(self::ENDPOINT_URL, [
            'greeting' => 'Awesome greet message',
        ]);
        $I->canSeeResponseCodeIs(201);
    }

    public function itShouldReturnBadRequestOnEmptyGreeting(FunctionalTester $I)
    {
        $I->wantTo('Given an request when greeting is empty then should return 400');
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST(self::ENDPOINT_URL, [
            'greeting' => '',
        ]);
        $I->canSeeResponseCodeIs(400);
    }

    public function itShouldReturnBadRequestOnEmptyRequest(FunctionalTester $I)
    {
        $I->wantTo('Given an request when is empty then should return 400');
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST(self::ENDPOINT_URL, null);
        $I->canSeeResponseCodeIs(400);
    }
}
