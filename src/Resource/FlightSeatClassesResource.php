<?php

namespace App\Resource;

use App\Entity\FlightSeatClasses;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FlightSeatClassesResource extends BaseResourceDTO
{
    public int $id;

    public string $name;

    public function __construct(FlightSeatClasses $flightSeatClasses)
    {
        $this->id =  $flightSeatClasses->getId();

        $this->name = $flightSeatClasses->getName();

        $this->data = $this->allocateData();
    }

    private function allocateData()
    {
        return [
            'id'    =>  $this->id,
            'name'  =>  $this->name,
        ];
    }
}
