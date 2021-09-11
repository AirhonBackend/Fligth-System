<?php

namespace App\Model;

use App\Entity\Destination;
use App\Entity\Terminal;
use App\Repository\DestinationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class TerminalModel
{
    public $name;

    public Destination $destination;

    public $terminal;

    public function __construct(string $name, Destination $destination = null)
    {
        $this->name = $name;
        $this->destination = $destination;
    }

    public static function fromRequest($request, Destination $destination)
    {
        $request = json_decode($request);

        return new static(
            $request->name,
            $destination
        );
    }
}
