<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class AirlineCompanyControllerTest extends ApiTestCase
{
    public function testStoreAirlineCompany(): void
    {
        $response = static::createClient()->request('POST', '/airline/new', ['json' => [
            'carrierName' => 'Airline 1',
            'headQuarters' => 'headquarters 2',
        ]]);

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
            'carrierName' => 'Airline 1',
            'headQuarters' => 'headquarters 2',
        ]);
    }

    public function testCollectionOfAirlineCompany(): void
    {
        $response = static::createClient()->request('GET', '/airline');

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
            [
                'carrierName' => 'Airline 1',
                'headQuarters' => 'headquarters 2',
            ],
            [
                'carrierName' => 'Airline 1',
                'headQuarters' => 'headquarters 2',
            ]
        ]);
    }
}
