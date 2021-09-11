<?php

namespace App\Resource;

use App\Entity\Flight;
use Symfony\Component\Serializer\SerializerInterface;

class FlightResource extends BaseResourceDTO
{
    public DestinationResource $destination;

    public TerminalResource $terminal;

    public int $capacity;

    public int $id;

    public $seats;

    public function __construct(Flight $flight)
    {
        $this->destination = new DestinationResource($flight->getDestination());
        $this->capacity = $flight->getCapacity();
        $this->id = $flight->getId();
        $this->terminal = new TerminalResource($flight->getTerminal());

        $this->seats = $flight->getFlightSeats();
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
        if (!empty($this->seats)) {
            foreach ($this->seats as $seat) {
                $collect[] = [
                    'passenger' =>  [
                        'firstName' =>  $seat->getPassenger()->getFirstName(),
                        'lastName'  =>  $seat->getPassenger()->getLastName(),
                        'age'       =>  $seat->getPassenger()->getAge(),
                        'gender'    =>  $seat->getPassenger()->getGender(),
                    ],
                    'airplane'  =>  [
                        'model'     =>  $seat->getAirplane()->getModel(),
                        'brand'     =>  $seat->getAirplane()->getBrand()
                    ]
                ];
            }
        }

        return $collect;
    }
}
