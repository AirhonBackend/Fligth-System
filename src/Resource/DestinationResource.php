<?php

namespace App\Resource;

use App\Entity\Destination;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DestinationResource
{
    public $destination;

    public function __construct(Destination $destination)
    {
        $this->destination = $destination;
    }

    public function transform()
    {
        return new JsonResponse($this->allocateData());
    }

    public static function fromCollection($destinationCollection): Response
    {
        $collection = [];
        foreach ($destinationCollection as $destination) {
            $destinationData = new static($destination);

            $collection[] = $destinationData->allocateData();
        }

        return new JsonResponse($collection);
    }

    public function allocateData()
    {
        return [
            'name'   =>  $this->destination->getname(),
        ];
    }
}
