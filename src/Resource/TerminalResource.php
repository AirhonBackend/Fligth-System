<?php

namespace App\Resource;

use App\Entity\Terminal;

class TerminalResource extends BaseResourceDTO
{
    public DestinationResource $destination;

    public string $name;

    public int $id;

    public function __construct(Terminal $terminal)
    {
        $this->destination = new DestinationResource($terminal->getDestination());
        $this->name = $terminal->getName();
        $this->id = $terminal->getId();

        $this->data = $this->allocateData();
    }

    public function allocateData()
    {
        return [
            'id'   =>  $this->id,
            'name'   =>  $this->name,
            'destination'   =>  [
                'name'   =>  $this->destination->name,
                'id'   =>  $this->destination->id,
            ],
        ];
    }
}
