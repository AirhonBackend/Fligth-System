<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class DestinationModel
{
    /**
     * @Assert\NotNull(message="Name is required")
     */
    public $name;

    public function __construct(string $name = null)
    {
        $this->name = $name;
    }

    public static function fromRequest($request)
    {
        $request = json_decode($request);

        return new static(
            $request->name ?? null
        );
    }
}
