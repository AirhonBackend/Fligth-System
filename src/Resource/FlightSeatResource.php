<?php

namespace App\Resource;

use App\Entity\FlightSeat;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FlightSeatResource
{

    public $flightSeat;

    public function __construct(FlightSeat $flightSeat)
    {
        $this->flightSeat = $flightSeat;
    }

    public function transform(): Response
    {
        return new JsonResponse([
            'destination'   =>  [
                'name'      =>  $this->flightSeat->getFlight()->getDestination()->getName(),
                'id'        =>  $this->flightSeat->getFlight()->getDestination()->getId(),
            ],
            $this->getSeatsForFlight()
        ]);
    }

    public function getSeatsForFlight()
    {
        return [
            'passenger' =>  [
                'firstName'     =>  $this->flightSeat->getPassenger() !== null ? $this->flightSeat->getPassenger()->getFirstName() : null,
                'lastName'      =>  $this->flightSeat->getPassenger() !== null ? $this->flightSeat->getPassenger()->getLastName() : null,
                'age'           =>  $this->flightSeat->getPassenger() !== null ? $this->flightSeat->getPassenger()->getAge() : null,
                'gender'        =>  $this->flightSeat->getPassenger() !== null ? $this->flightSeat->getPassenger()->getGender() : null,
                'id'            =>  $this->flightSeat->getPassenger() !== null ?  $this->flightSeat->getPassenger()->getId() : null,
            ],
            'seatClass' =>  [
                'name'  =>  $this->flightSeat->getFlightSeatClass() !== null ? $this->flightSeat->getFlightSeatClass()->getName() : null,
                'id'    =>  $this->flightSeat->getFlightSeatClass() !== null ? $this->flightSeat->getFlightSeatClass()->getId() : null,
            ],
            'airplane' =>  [
                'model'  =>  $this->flightSeat->getAirplane()->getModel(),
                'brand'  =>  $this->flightSeat->getAirplane()->getBrand(),
            ],
            'status'    =>  $this->flightSeat->getStatus(),
            'seatNumber' => $this->flightSeat->getNumber()
        ];
    }
}
