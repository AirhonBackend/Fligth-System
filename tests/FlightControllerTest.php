<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class FlightControllerTest extends ApiTestCase
{
    public function testStoreFlightSeat(): void
    {
        $response = static::createClient()->request('POST', '/flight-seat-class/new', ['json' => [
            'name' =>  'economy',
        ]]);

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
            'name'   => 'economy'
        ]);
    }

    public function testStoreFlight(): void
    {
        $response = static::createClient()->request('POST', '/flight/new', ['json' => [
            'destinationId' =>  1,
            'terminalId' =>  1,
            'airplaneId' =>  1,
            'capacity' =>  20,
        ]]);

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
            'destination'   =>  [
                'name'  =>  'North America',
                'id'  =>  1,
            ],
            'terminal'   =>  [
                'name'  =>  'Terminal 2',
                'id'  =>  1,
            ]
        ]);
    }

    public function testFlightCollection(): void
    {
        $response = static::createClient()->request('GET', '/flight');

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
            [
                'destination'   =>  [
                    'name'  =>  'North America',
                    'id'  =>  1,
                ],
                'terminal'   =>  [
                    'name'  =>  'Terminal 2',
                    'id'  =>  1,
                ],
                'seats' =>  []

            ]

        ]);
    }

    public function testFlightBooking(): void
    {
        $response = static::createClient()->request('POST', '/book/seat/104', ['json' => [
            'passengerId'   =>  1,
            'flightSeatClassId'   =>  1,
        ]]);

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
            'destination'   =>  [
                'name'  =>  'North America',
                'id'  =>  1,
            ],
            'seat' =>  [
                'passenger' =>  [
                    'firstName' =>  'John',
                    'lastName' =>  'Cortez',
                    'age' =>  '37',
                    'gender' =>  "Male",
                ]
            ]
        ]);
    }
}
