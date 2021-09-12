<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class FlightModel
{

    /**
     * @Assert\NotNull(message="Destination id field is required")
     */
    public $destinationId;

    /**
     * @Assert\NotNull(message="Terminal id field is required")
     */
    public $terminalId;

    /**
     * @Assert\NotNull(message="Capacity field is required")
     */
    public $capacity;

    public function __construct(int $destinationId = null, int $terminalId = null, int $capacity = null)
    {
        $this->destinationId = $destinationId;
        $this->terminalId = $terminalId;
        $this->capacity = $capacity;
    }

    public static function fromRequest($request): self
    {
        $request = json_decode($request);
        return new static(
            $request->destinationId ?? null,
            $request->terminalId ?? null,
            $request->capacity ?? null,
        );
    }
}
