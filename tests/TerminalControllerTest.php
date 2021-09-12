<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class TerminalControllerTest extends ApiTestCase
{
    public function testStoreTerminal(): void
    {
        $response = static::createClient()->request('GET', '/destinations/1/terminals', ['json' => [
            'name'  =>  'Terminal 2'
        ]]);

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains(['name' => 'Terminal 2']);
    }
}
