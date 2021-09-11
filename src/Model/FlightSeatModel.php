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
use Exception;
use Illuminate\Support\Str;

class FlightSeatModel
{
    public $seatNumber;

    public $flight;

    public $airplaneId;

    public $status;

    public $passengerId;

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
            $flight,
            $request->airplaneId,
            'occupied',
            $request->passengerId,
            $request->flightSeatClassId
        );
    }

    // public function getPassenger(PassengerRepository $passengerRepository)
    // {
    //     return $passengerRepository->find($this->passengerId);
    // }

    // public function getFlightSeatClass(FlightSeatClassesRepository $flightSeatClassesRepository)
    // {
    //     return $flightSeatClassesRepository->find($this->flightSeatClassId);
    // }

    // public function bookFlight(EntityManagerInterface $entityManagerInterface): FlightSeat
    // {
    //     $passenger = $this->getPassenger($entityManagerInterface->getRepository(Passenger::class));
    //     $flightSeatClass = $this->getFlightSeatClass($entityManagerInterface->getRepository(FlightSeatClasses::class));

    //     if (!$passenger) {
    //         throw new Exception('Passenger not found');
    //     }

    //     if (!$flightSeatClass) {
    //         throw new Exception('Seat Class not found');
    //     }

    //     $this->flightSeat->setPassenger($passenger)
    //         ->setFlightSeatClass($this->getFlightSeatClass($entityManagerInterface->getRepository(FlightSeatClasses::class)))
    //         ->setStatus($this->status);

    //     $this->flightSeat->getFlight()->decrementCapacity();

    //     $entityManagerInterface->flush();

    //     return $this->flightSeat;
    // }
}
