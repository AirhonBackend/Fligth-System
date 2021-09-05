<?php

namespace App\Resource;

use App\Entity\Flight;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FlightResource
{
    public $flight;

    public $destination;

    public function __construct(Flight $flight)
    {
        $this->flight = $flight;
    }

    public function transform(): Response
    {
        return new JsonResponse([
            'data'      => [
                'destination'       =>  [
                    'name'          =>  $this->flight->getDestination()->getName(),
                    'id'            =>  $this->flight->getDestination()->getId()
                ],
                'terminal'          =>  [
                    'name'          =>  $this->flight->getTerminal()->getName(),
                    'id'            =>  $this->flight->getTerminal()->getId()
                ],
                'seats'             => $this->getSeatsAvailable()
            ]
        ]);
    }

    private function getSeatsAvailable()
    {
        $collect = [];
        foreach ($this->flight->getFlightSeats()->getValues() as $seat) {
            $flightSeat = new FlightSeatResource($seat);
            $collect[] = $flightSeat->getSeatsForFlight();
        }
        return $collect;
    }

    // public static function fromCollection($flightCollection)
    // {

    // }
}
