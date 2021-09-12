<?php

namespace App\Resource;

use App\Entity\FlightSeat;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FlightSeatResource extends BaseResourceDTO
{

    public string $status;

    public string $seatNumber;

    public FlightResource $flight;

    public PassengerResource $passenger;

    public  AirplaneResource $airplane;

    public FlightSeatClassesResource $seatClass;

    public function __construct(FlightSeat $flightSeat)
    {
        $this->status = $flightSeat->getStatus();
        $this->seatNumber = $flightSeat->getNumber();

        $this->flight = new FlightResource($flightSeat->getFlight());
        $this->passenger = new PassengerResource($flightSeat->getPassenger());
        $this->seatClass = new FlightSeatClassesResource($flightSeat->getFlightSeatClass());
        $this->airplane = new AirplaneResource($flightSeat->getAirplane());

        $this->data = $this->allocateData();
    }

    private function allocateData()
    {
        return [
            'destination'   =>  $this->flight->destination->data,
            'passenger'     =>  $this->passenger->data,
            'seatClass'     =>  $this->seatClass->data,
            'airplane'      =>  $this->airplane->data
        ];
    }
}
