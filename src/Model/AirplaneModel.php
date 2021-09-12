<?php

namespace App\Model;

use App\Entity\AirlineCompany;
use Symfony\Component\Validator\Constraints as Assert;

class AirplaneModel
{
    public AirlineCompany $airlineCompany;

    /**
     * @Assert\NotNull(message="Brand is required")
     */
    public $brand;

    /**
     * @Assert\NotNull(message="Model is required")
     */
    public $model;

    public $airplane;

    public $airplaneId;

    public function __construct(AirlineCompany $airlineCompany = null, string $brand = null, string $model = null, string $airplaneId = null)
    {
        $this->airlineCompany = $airlineCompany;
        $this->brand = $brand;
        $this->model = $model;
        $this->airplaneId = $airplaneId;
    }

    public static function fromRequest($request, AirlineCompany $airlineCompany)
    {
        $request = json_decode($request);

        return new static(
            $airlineCompany,
            $request->brand ?? null,
            $request->model ?? null,
        );
    }

    public static function fromRequestUpdate($request, $airlineCompanyId, $airplaneId)
    {
        $request = json_decode($request);

        return new static(
            $airlineCompanyId,
            $request->brand ?? null,
            $request->model ?? null,
            $airplaneId
        );
    }
}
