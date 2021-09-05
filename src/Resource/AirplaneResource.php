<?php

namespace App\Resource;

use App\Entity\Airplane;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AirplaneResource
{
    public $airplane;

    public function __construct(Airplane $airplane)
    {
        $this->airplane = $airplane;
    }

    public function transform()
    {
        return new JsonResponse($this->allocateData());
    }

    public static function fromCollection($airplaneCollection): Response
    {
        $collection = [];
        foreach ($airplaneCollection as $airplane) {
            $airplaneData = new static($airplane);

            $collection[] = $airplaneData->allocateData();
        }

        return new JsonResponse($collection);
    }

    public function allocateData()
    {
        return [
            'brand'   =>  $this->airplane->getBrand(),
            'model'   =>  $this->airplane->getModel(),
            'airplaneCompany'   =>  [
                'carrierName'   =>  $this->airplane->getAirlineCompany()->getCarrierName(),
                'headQuarters'   =>  $this->airplane->getAirlineCompany()->getHeadQuarters()
            ],
        ];
    }
}
