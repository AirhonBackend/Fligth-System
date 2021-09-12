<?php

namespace App\Model;

use App\Entity\Destination;
use Symfony\Component\Validator\Constraints as Assert;

class TerminalModel
{

    /**
     * @Assert\NotNull(message="Name is required")
     */
    public $name;

    public Destination $destination;

    public $terminal;

    public function __construct(string $name = null, Destination $destination = null)
    {
        $this->name = $name;
        $this->destination = $destination;
    }

    public static function fromRequest($request, Destination $destination)
    {
        $request = json_decode($request);

        return new static(
            $request->name ?? null,
            $destination
        );
    }
}
