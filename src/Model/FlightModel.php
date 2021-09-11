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

    public $capacity;

    public function __construct(int $destinationId, int $terminalId, int $capacity)
    {
        $this->destinationId = $destinationId;
        $this->terminalId = $terminalId;
        $this->capacity = $capacity;
    }

    public static function fromRequest($request): self
    {
        $request = json_decode($request);
        return new static(
            $request->destinationId,
            $request->terminalId,
            $request->capacity,
        );
    }
}
