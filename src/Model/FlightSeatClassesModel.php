<?php

namespace App\Model;

use App\Entity\FlightSeatClasses;
use Doctrine\ORM\EntityManagerInterface;

class FlightSeatClassesModel
{
    public $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function fromRequest($request)
    {
        $request = json_decode($request);

        return new static(
            $request->name,
        );
    }
}
