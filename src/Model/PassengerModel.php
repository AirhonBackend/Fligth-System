<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class PassengerModel
{
    /**
     * @Assert\NotNull(message="First name field is required")
     */
    public $firstName;

    public $middleName;

    /**
     * @Assert\NotNull(message="Last name field is required")
     */
    public $lastName;

    /**
     * @Assert\NotNull(message="Age field is required")
     */
    public $age;

    /**
     * @Assert\NotNull(message="Gender field is required")
     */
    public $gender;

    public $passenger;

    public function __construct(string $firstName = null, string $middleName = null, string $lastName = null, int $age = null, string $gender = null)
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
            $request->firstName ?? null,
            $request->middleName ?? null,
            $request->lastName ?? null,
            $request->age ?? null,
            $request->gender ?? null,
        );
    }
}
