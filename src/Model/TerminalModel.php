<?php

namespace App\Model;

use App\Entity\Destination;
use App\Entity\Terminal;
use App\Repository\DestinationRepository;
use Doctrine\ORM\EntityManagerInterface;

class TerminalModel
{
    public $name;

    public $destinationId;

    public $terminal;

    public function __construct(string $name, int $destinationId)
    {
        $this->name = $name;
        $this->destinationId = $destinationId;
    }

    public static function fromRequest($request, int $destinationId)
    {
        $request = json_decode($request);

        return new static(
            $request->name,
            $destinationId
        );
    }

    public function getDestination(DestinationRepository $destinationRepository)
    {
        return $destinationRepository->find($this->destinationId);
    }

    public function createTerminal(EntityManagerInterface $entityManagerInterface)
    {
        $this->terminal = new Terminal();

        $destinationRepository = $entityManagerInterface->getRepository(Destination::class);

        $this->terminal->setName($this->name)
            ->setDestination($this->getDestination($destinationRepository));

        $entityManagerInterface->persist($this->terminal);

        $entityManagerInterface->flush();

        return $this->terminal;
    }
}
