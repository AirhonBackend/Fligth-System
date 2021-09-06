<?php

namespace App\Model;

use App\Entity\Flight;
use App\Entity\Airplane;
use App\Entity\Terminal;
use App\Entity\FlightSeat;
use App\Entity\Destination;
use Illuminate\Support\Str;
use App\Repository\AirplaneRepository;
use App\Repository\TerminalRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\DestinationRepository;
use App\Model\FlightSeatModel;
use Exception;

class FlightModel
{

    public $destinationId;

    public $terminalId;

    public $airplaneId;

    public $capacity;

    public $entityManager;

    public $flight;

    public function __construct(int $destinationId, int $terminalId, int $airplaneId, int $capacity)
    {
        $this->destinationId = $destinationId;
        $this->terminalId = $terminalId;
        $this->airplaneId = $airplaneId;
        $this->capacity = $capacity;

        return $this;
    }

    public static function fromRequest($request): self
    {
        $request = json_decode($request);
        return new static(
            $request->destinationId,
            $request->terminalId,
            $request->airplaneId,
            $request->capacity,
        );
    }

    public function getDestination(DestinationRepository $destinationRepository)
    {
        return $destinationRepository->find($this->destinationId);
    }

    public function getTerminal(TerminalRepository $terminalRepository)
    {
        return $terminalRepository->find($this->terminalId);
    }

    public function getAirplane(AirplaneRepository $airplaneRepository)
    {
        return $airplaneRepository->find($this->airplaneId);
    }

    public function createFlight(EntityManagerInterface $entityManagerInterface)
    {
        $this->flight = new Flight();

        $destinationRepository = $entityManagerInterface->getRepository(Destination::class);
        $terminalRepository = $entityManagerInterface->getRepository(Terminal::class);
        $airplaneRepository = $entityManagerInterface->getRepository(Airplane::class);

        $destination = $this->getDestination($destinationRepository);
        $terminal = $this->getTerminal($terminalRepository);
        $terminal = $this->getTerminal($terminalRepository);

        if (!$terminal) {
            throw new Exception('Terminal not found');
        }

        if (!$destination) {
            throw new Exception('Destination not found');
        }

        $airplane = $this->getAirplane($airplaneRepository);

        if (!$airplane) {
            throw new Exception('Airplane not found');
        }

        $this->flight->setDestination($destination)
            ->setTerminal($terminal)
            ->setCapacity($this->capacity);

        $entityManagerInterface->persist($this->flight);

        $this->setFlightSeats($airplane, $entityManagerInterface);

        $entityManagerInterface->flush();

        return $this->flight;
    }

    private function setFlightSeats(Airplane $airplane, EntityManagerInterface $entityManagerInterface)
    {
        foreach (range(1, $this->capacity) as $seat) {
            $flightSeatEntity = new FlightSeat();
            $flightSeat = new FlightSeatModel(Str::upper(Str::random(5)) . $seat, $this->flight, $airplane, 'available');
            $flightSeat->createFlightSeat($entityManagerInterface, $flightSeatEntity);
        }
    }
}
