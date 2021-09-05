<?php

namespace App\Resource;

use App\Entity\Passenger;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PassengerResource
{
    public $passenger;

    public function __construct(Passenger $passenger)
    {
        $this->passenger = $passenger;
    }

    public function transform()
    {
        return new JsonResponse($this->allocateData());
    }

    public static function fromCollection($passengerCollection): Response
    {
        $collection = [];
        foreach ($passengerCollection as $passenger) {
            $passengerData = new static($passenger);

            $collection[] = $passengerData->allocateData();
        }

        return new JsonResponse($collection);
    }

    public function allocateData()
    {
        return [
            'firstName'     =>  $this->passenger->getFirstName(),
            'lastName'      =>  $this->passenger->getLastName(),
            'age'           =>  $this->passenger->getAge(),
            'gender'        =>  $this->passenger->getGender(),
        ];
    }
}
