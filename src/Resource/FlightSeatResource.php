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
        $this->airplane = new AirplaneResource($flightSeat->getAirplane());
        $this->seatClass = new FlightSeatClassesResource($flightSeat->getFlightSeatClass());

        $this->data = $this->allocateData();
    }

    private function allocateData()
    {
        return [
            'destination'   =>  [
                'id'    =>  $this->flight->destination->id,
                'name'  =>  $this->flight->destination->name,
            ],
            'passenger' =>  [
                'firstName' =>  $this->passenger->firstName,
                'lastName'  =>  $this->passenger->lastName,
                'age'       =>  $this->passenger->age,
                'gender'    =>  $this->passenger->gender,
                'id'        =>  $this->passenger->id
            ],
            'seatClass' =>  [
                'name'      =>  $this->seatClass->name,
                'id'        =>  $this->seatClass->id
            ],
            'airplane'  =>  [
                'id'    =>  $this->airplane->id,
                'model' =>  $this->airplane->model,
                'brand' =>  $this->airplane->brand
            ]
        ];
    }
}
