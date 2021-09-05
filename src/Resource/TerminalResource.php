<?php

namespace App\Resource;

use App\Entity\Terminal;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TerminalResource
{
    public $terminal;

    public function __construct(Terminal $terminal)
    {
        $this->terminal = $terminal;
    }

    public function transform()
    {
        return new JsonResponse($this->allocateData());
    }

    public static function fromCollection($terminalCollection): Response
    {
        $collection = [];
        foreach ($terminalCollection as $terminal) {
            $terminalData = new static($terminal);

            $collection[] = $terminalData->allocateData();
        }

        return new JsonResponse($collection);
    }

    public function allocateData()
    {
        return [
            'name'   =>  $this->terminal->getName(),
            'destination'   =>  [
                'name'   =>  $this->terminal->getDestination()->getName(),
                'id'   =>  $this->terminal->getDestination()->getId(),
            ],
        ];
    }
}
