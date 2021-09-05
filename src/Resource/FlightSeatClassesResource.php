<?php

namespace App\Resource;

use App\Entity\FlightSeatClasses;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FlightSeatClassesResource
{
    public $flightSeatClasses;

    public function __construct(FlightSeatClasses $flightSeatClasses)
    {
        $this->flightSeatClasses =  $flightSeatClasses;
    }

    public function transform()
    {
        return new JsonResponse($this->allocateData());
    }

    public static function fromCollection($flightSeatClassesCollection): Response
    {
        $collection = [];
        foreach ($flightSeatClassesCollection as $flightSeatClasses) {
            $flightSeatClassesData = new static($flightSeatClasses);

            $collection[] = $flightSeatClassesData->allocateData();
        }

        return new JsonResponse($collection);
    }

    public function allocateData()
    {
        return [
            'name'   =>  $this->flightSeatClasses->getName(),
        ];
    }
}
