<?php

declare(strict_types=1);

namespace Tests\integration;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class IntegrationTestCase extends KernelTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        self::bootKernel();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }
}
