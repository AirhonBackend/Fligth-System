<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class PassengerControllerTest extends ApiTestCase
{
    public function testStorePassenger(): void
    {
        $response = static::createClient()->request('POST', '/passsengers', ['json' => []]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertJsonContains([
            'errors' => [
                'firstName'   =>  ['First name field is required'],
                'lastName'   =>  ['Last name field is required'],
                'age'   =>  ['Age field is required'],
                'gender'   =>  ['Gender field is required'],
            ]
        ]);

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
            'age' =>  37,
            'gender' =>  "Male",
        ]);
    }

    public function testCollectionOfPassengers(): void
    {
        $response = static::createClient()->request('GET', '/passsengers', ['json' => [
            'firstName' =>  'John',
            'middleName' =>  'Middle',
            'lastName' =>  'Cortez',
            'age' =>  37,
            'gender' =>  "Male",
        ]]);

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
            [
                'firstName' =>  'John',
                'lastName' =>  'Cortez',
                'age' =>  37,
                'gender' =>  "Male",
            ],
            [
                'firstName' =>  'John',
                'lastName' =>  'Cortez',
                'age' =>  37,
                'gender' =>  "Male",
            ],
        ]);
    }

    public function testShowPassenger(): void
    {
        $response = static::createClient()->request('GET', '/passsengers/1', ['json' => [
            'firstName' =>  'John',
            'middleName' =>  'Middle',
            'lastName' =>  'Cortez',
            'age' =>  37,
            'gender' =>  "Male",
        ]]);

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains(
            [
                'firstName' =>  'John',
                'lastName' =>  'Cortez',
                'age' =>  37,
                'gender' =>  "Male",
            ],
        );
    }
}
