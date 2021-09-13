<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class TerminalControllerTest extends ApiTestCase
{
    public function testStoreTerminal(): void
    {
        $response = static::createClient()->request('POST', '/destinations/1/terminals', ['json' => []]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertJsonContains([
            'errors' => [
                'name'   =>  ['Name field is required'],
            ]
        ]);

        $response = static::createClient()->request('POST', '/destinations/1/terminals', ['json' => [
            'name'  =>  'Terminal 2'
        ]]);

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains(['name' => 'Terminal 2']);
    }

    public function testCollectionOfTerminals(): void
    {
        $response = static::createClient()->request('GET', '/terminals', ['json' => [
            'name'  =>  'Terminal 2'
        ]]);

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
            ['name' => 'Terminal 2'],
            ['name' => 'Terminal 2'],
        ]);
    }

    public function testShowTerminals(): void
    {
        $response = static::createClient()->request('GET', '/terminals/1', ['json' => [
            'name'  =>  'Terminal 2'
        ]]);

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains(
            ['name' => 'Terminal 2'],
        );
    }
}
