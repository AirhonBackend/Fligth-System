<?php

namespace App\Resource;

use App\Entity\Destination;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DestinationResource extends BaseResourceDTO
{
    public string $name;

    public string $id;

    public function __construct(Destination $destination)
    {
        $this->name = $destination->getName();
        $this->id = $destination->getId();

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
