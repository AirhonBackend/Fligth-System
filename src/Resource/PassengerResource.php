<?php

namespace App\Resource;

use App\Entity\Passenger;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PassengerResource extends BaseResourceDTO
{

    public int $id;
    public string $firstName;

    public string $lastName;

    public int $age;

    public string $gender;

    public function __construct(Passenger $passenger)
    {
        $this->id = $passenger->getId();
        $this->firstName = $passenger->getFirstName();
        $this->lastName = $passenger->getLastName();
        $this->age = $passenger->getAge();
        $this->gender = $passenger->getGender();

        $this->data = $this->allocateData();
    }


    private function allocateData()
    {
        return [
            'firstName'     =>  $this->firstName,
            'lastName'      =>  $this->lastName,
            'age'           =>  $this->age,
            'gender'        =>  $this->gender,
        ];
    }
}
