<?php

namespace App\Model;

use App\Entity\AirlineCompany;
use App\Entity\Airplane;
use App\Repository\AirlineCompanyRepository;
use App\Repository\AirplaneRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class AirplaneModel
{
    public AirlineCompany $airlineCompany;

    public $brand;

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

    public function getAirlineCompany(AirlineCompanyRepository $airlineCompanyRepository)
    {
        return $airlineCompanyRepository->find($this->airlineCompanyId);
    }

    public static function fromRequest($request, AirlineCompany $airlineCompany)
    {
        $request = json_decode($request);

        return new static(
            $airlineCompany,
            $request->brand,
            $request->model,
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

    public function getAirplane(AirplaneRepository $airplaneRepository)
    {
        return $airplaneRepository->find($this->airplaneId);
    }
}
