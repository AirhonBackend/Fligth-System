<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class FlightControllerTest extends ApiTestCase
{
    public function testStoreFlightSeat(): void
    {
        $response = static::createClient()->request('POST', '/flight-seat-classes', ['json' => []]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertJsonContains([
            'errors' => [
                'name'   =>  ['Name is required'],
            ]
        ]);

        $response = static::createClient()->request('POST', '/flight-seat-classes', ['json' => [
            'name' =>  'economy',
        ]]);

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
            'name'   => 'economy'
        ]);
    }

    public function testStoreFlight(): void
    {
        $response = static::createClient()->request('POST', '/flights', ['json' => []]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertJsonContains([
            'errors' => [
                'destinationId'   =>  ['Destination id field is required'],
                'terminalId'   =>  ['Terminal id field is required'],
                'capacity'   =>  ['Capacity field is required'],
            ]
        ]);

        $response = static::createClient()->request('POST', '/flights', ['json' => [
            'destinationId' =>  1,
            'terminalId' =>  1,
            'capacity' =>  20,
        ]]);

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
            'destination'   =>  [
                'name'  =>  'North America',
            ],
            'terminal'   =>  [
                'name'  =>  'Terminal 2',
            ]
        ]);
    }

    public function testFlightCollection(): void
    {
        $response = static::createClient()->request('GET', '/flights');

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
            [
                'destination'   =>  [
                    'name'  =>  'North America',
                ],
                'terminal'   =>  [
                    'name'  =>  'Terminal 2',
                ],
                'seats' =>  []

            ]

        ]);
    }

    public function testFlightBooking(): void
    {

        $response = static::createClient()->request('POST', '/flights/1/book', ['json' => []]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertJsonContains([
            'errors' => [
                'passengerId'   =>  ['Passenger Id field is required'],
                'flightSeatClassId'   =>  ['Flight seat class Id field is required'],
                'airplaneId'   =>  ['Airplane Id field is required'],
            ]
        ]);

        $response = static::createClient()->request('POST', '/flights/1/book', ['json' => [
            'passengerId'   =>  1,
            'flightSeatClassId'   =>  1,
            'airplaneId'   =>  1,
        ]]);

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
            'destination'   =>  [
                'name'  =>  'North America',
            ],
            'passenger' =>  [
                'firstName' =>  'John',
                'lastName' =>  'Cortez',
                'age' =>  37,
                'gender' =>  "Male",
            ],
            'seatClass' =>  [
                'name'  =>  'economy'
            ],
        ]);
    }
}
