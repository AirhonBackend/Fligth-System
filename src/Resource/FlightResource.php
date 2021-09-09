<?php

namespace App\Resource;

use App\Entity\Flight;

class FlightResource extends BaseResourceDTO
{
    public DestinationResource $destination;

    public TerminalResource $terminal;

    public int $capacity;

    public int $id;

    public function __construct(Flight $flight)
    {
        $this->destination = new DestinationResource($flight->getDestination());
        $this->capacity = $flight->getCapacity();
        $this->id = $flight->getId();
        $this->terminal = new TerminalResource($flight->getTerminal());

        $this->data = $this->allocateData();
    }

    private function allocateData()
    {
        return $this->data = [
            'destination'       =>  [
                'name'          =>  $this->destination->name,
                'id'            =>  $this->destination->id
            ],
            'terminal'          =>  [
                'name'          =>  $this->terminal->name,
                'id'            =>  $this->terminal->id
            ],
            'seats'             => $this->getSeatsAvailable()
        ];
    }

    private function getSeatsAvailable()
    {
        $collect = [];
        foreach ($this->flight->getFlightSeats()->getValues() as $seat) {
            $flightSeat = new FlightSeatResource($seat);
            $collect[] = $flightSeat->data;
        }
        return $collect;
    }
}
