<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class PassengerControllerTest extends ApiTestCase
{
    public function testSomething(): void
    {
        $response = static::createClient()->request('POST', '/passsengers', ['json' => [
            'firstName' =>  'John',
            'middleName' =>  'Middle',
            'lastName' =>  'Cortez',
            'age' =>  37,
            'gender' =>  "Male",
        ]]);

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
            'firstName' =>  'John',
            'lastName' =>  'Cortez',
            'age' =>  '37',
            'gender' =>  "Male",
        ]);
    }
}
