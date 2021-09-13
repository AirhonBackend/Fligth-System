<?php

namespace App\Model;

use App\Entity\Destination;
use Symfony\Component\Validator\Constraints as Assert;

class TerminalModel
{

    /**
     * @Assert\NotNull(message="Name field is required")
     */
    public $name;

    public $destination;

    public $terminal;

    public function __construct(string $name = null, Destination $destination = null)
    {
        $this->name = $name;
        $this->destination = $destination;
    }

    public static function fromRequest($request, Destination $destination = null)
    {
        $request = json_decode($request);

        return new static(
            $request->name ?? null,
            $destination ?? null
        );
    }
}
