<?php

namespace App\Model;

use App\Entity\Destination;
use Doctrine\ORM\EntityManagerInterface;

class DestinationModel
{
    public $name;

    public $destination;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function fromRequest($request)
    {
        $request = json_decode($request);

        return new static(
            $request->name
        );
    }

    public function createDestination(EntityManagerInterface $entityManagerInterface)
    {
        $this->destination = new Destination();

        $this->destination->setName($this->name);

        $entityManagerInterface->persist($this->destination);
        $entityManagerInterface->flush();

        return $this->destination;
    }
}
