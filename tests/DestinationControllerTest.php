<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class DestinationControllerTest extends ApiTestCase
{
    public function testStoreDestination(): void
    {
        $response = static::createClient()->request('POST', '/destination/new', ['json' => [
            'name'  =>  'North America'
        ]]);

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains(['name' => 'North America']);
    }

    public function testCollectionOfDestinations(): void
    {
        $response = static::createClient()->request('GET', '/destination');

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
            ['name' => 'North America'],
            ['name' => 'North America'],
        ]);
    }
}
