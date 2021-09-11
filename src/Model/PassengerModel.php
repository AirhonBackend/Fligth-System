<?php

namespace App\Model;

use App\Entity\Passenger;
use Doctrine\ORM\EntityManagerInterface;

class PassengerModel
{
    public $firstName;

    public $middleName;

    public $lastName;

    public $age;

    public $gender;

    public $passenger;

    public function __construct(string $firstName, string $middleName = null, string $lastName, int $age, string $gender)
    {
        $this->firstName = $firstName;
        $this->middleName = $middleName;
        $this->lastName = $lastName;
        $this->age = $age;
        $this->gender = $gender;
    }

    public static function fromRequest($request)
    {
        $request = json_decode($request);

        return new static(
            $request->firstName,
            $request->middleName,
            $request->lastName,
            $request->age,
            $request->gender,
        );
    }

    // public function createPassenger(EntityManagerInterface $entityManagerInterface)
    // {
    //     $this->passenger = new Passenger();

    //     $this->passenger->setFirstName($this->firstName)
    //         ->setMiddleName($this->middleName ?? null)
    //         ->setLastName($this->lastName)
    //         ->setAge($this->age)
    //         ->setGender($this->gender);

    //     $entityManagerInterface->persist($this->passenger);
    //     $entityManagerInterface->flush();

    //     return $this->passenger;
    // }
}
