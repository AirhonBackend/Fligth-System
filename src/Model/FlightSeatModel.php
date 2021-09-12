<?php

namespace App\Model;

use App\Entity\Flight;
use App\Entity\FlightSeat;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Support\Str;
use Symfony\Component\Validator\Constraints as Assert;

class FlightSeatModel
{
    /**
     * @Assert\NotNull(message="Seatnumber field is required")
     */
    public $seatNumber;

    public $flight;

    /**
     * @Assert\NotNull(message="Airplane Id field is required")
     */
    public $airplaneId;

    /**
     * @Assert\NotNull(message="Status field is required")
     */
    public $status;

    /**
     * @Assert\NotNull(message="Passenger Id field is required")
     */
    public $passengerId;

    /**
     * @Assert\NotNull(message="Flight seat class Id field is required")
     */
    public $flightSeatClassId;

    public $flightSeatClass;

    public function __construct(string $seatNumber = null, Flight $flight = null, int $airplaneId = null, string $status = null, int $passengerId = null, int $flightSeatClassId = null)
    {
        $this->seatNumber = $seatNumber;
        $this->flight = $flight;
        $this->airplaneId = $airplaneId;
        $this->status = $status;
        $this->passengerId = $passengerId;
        $this->flightSeatClassId = $flightSeatClassId;
    }

    public function createFlightSeat(EntityManagerInterface $entityManagerInterface, FlightSeat $flightSeat): FlightSeat
    {
        $flightSeat->setNumber($this->seatNumber)
            ->setFlight($this->flight)
            ->setAirplane($this->airplane)
            ->setStatus($this->status);

        $entityManagerInterface->persist($flightSeat);

        return $flightSeat;
    }

    public static function fromRequest($request, Flight $flight)
    {
        $request = json_decode($request);

        return new static(
            Str::upper(Str::random(5)),
            $flight ?? null,
            $request->airplaneId ?? null,
            'occupied' ?? null,
            $request->passengerId ?? null,
            $request->flightSeatClassId ?? null
        );
    }
}
