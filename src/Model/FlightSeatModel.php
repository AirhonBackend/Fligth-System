<?php

namespace App\Model;

use App\Entity\Flight;
use App\Entity\Airplane;
use App\Entity\FlightSeat;
use App\Entity\FlightSeatClasses;
use App\Entity\Passenger;
use App\Repository\FlightRepository;
use App\Repository\FlightSeatClassesRepository;
use App\Repository\FlightSeatRepository;
use App\Repository\PassengerRepository;
use Doctrine\ORM\EntityManagerInterface;

class FlightSeatModel
{
    public $seatNumber;

    public $flight;

    public $airplane;

    public $status;

    public $flightSeat;

    public $passengerId;

    public $flightSeatClassId;

    public $flightSeatClass;

    public function __construct(string $seatNumber = null, Flight $flight = null, Airplane $airplane = null, string $status = null, FlightSeat $flightSeat = null, int $passengerId = null, int $flightSeatClassId = null)
    {
        $this->seatNumber = $seatNumber;
        $this->flight = $flight;
        $this->airplane = $airplane;
        $this->status = $status;
        $this->flightSeat = $flightSeat;
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

    public static function fromRequest($request, FlightSeat $flightSeat)
    {
        $request = json_decode($request);

        return new static(
            null,
            null,
            null,
            'occupied',
            $flightSeat,
            $request->passengerId,
            $request->flightSeatClassId
        );
    }

    public function getPassenger(PassengerRepository $passengerRepository)
    {
        return $passengerRepository->find($this->passengerId);
    }

    public function getFlightSeatClass(FlightSeatClassesRepository $flightSeatClassesRepository)
    {
        return $flightSeatClassesRepository->find($this->flightSeatClassId);
    }

    public function bookFlight(EntityManagerInterface $entityManagerInterface): FlightSeat
    {
        $this->flightSeat->setPassenger($this->getPassenger($entityManagerInterface->getRepository(Passenger::class)))
            ->setFlightSeatClass($this->getFlightSeatClass($entityManagerInterface->getRepository(FlightSeatClasses::class)))
            ->setStatus($this->status);

        $this->flightSeat->getFlight()->decrementCapacity();

        $entityManagerInterface->flush();

        return $this->flightSeat;
    }
}
