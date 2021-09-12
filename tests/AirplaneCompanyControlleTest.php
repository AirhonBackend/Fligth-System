<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class AirplaneCompanyControlleTest extends ApiTestCase
{
    public function testStoreAirplane(): void
    {

        $response = static::createClient()->request('POST', '/airlines/1/airplanes', ['json' => [
            'brand'  =>  'Toyota',
            'model'  =>   'TTOEA13'
        ]]);

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
            'brand' => 'Toyota',
            'model' => 'TTOEA13',
        ]);
    }

    public function testCollectionofAirplanes(): void
    {
        $response = static::createClient()->request('GET', '/airplanes');

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
            [
                'brand' => 'Toyota',
                'model' => 'TTOEA13',
            ],
            [
                'brand' => 'Toyota',
                'model' => 'TTOEA13',
            ]
        ]);
    }
}
