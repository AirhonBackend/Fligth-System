<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class DestinationControllerTest extends ApiTestCase
{
    public function testStoreDestination(): void
    {
        $response = static::createClient()->request('POST', '/destinations', ['json' => []]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertJsonContains([
            'errors' => [
                'name'   =>  ['Name is required'],
            ]
        ]);

        $response = static::createClient()->request('POST', '/destinations', ['json' => [
            'name'  =>  'North America'
        ]]);

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains(['name' => 'North America']);
    }

    public function testCollectionOfDestinations(): void
    {
        $response = static::createClient()->request('GET', '/destinations');

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
            ['name' => 'North America'],
            ['name' => 'North America'],
        ]);
    }

    public function testShowDestinations(): void
    {
        $response = static::createClient()->request('GET', '/destinations/1');

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains(
            ['name' => 'North America'],
        );
    }
}
