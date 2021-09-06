<?php

namespace App\Model;

use App\Entity\AirlineCompany;
use App\Entity\Airplane;
use App\Repository\AirlineCompanyRepository;
use App\Repository\AirplaneRepository;
use Doctrine\ORM\EntityManagerInterface;

class AirplaneModel
{
    public $airlineCompanyId;

    public $brand;

    public $model;

    public $airplane;

    public $airplaneId;

    public function __construct(string $airlineCompanyId = null, string $brand = null, string $model = null, string $airplaneId = null)
    {
        $this->airlineCompanyId = $airlineCompanyId;
        $this->brand = $brand;
        $this->model = $model;
        $this->airplaneId = $airplaneId;
    }

    public function getAirlineCompany(AirlineCompanyRepository $airlineCompanyRepository)
    {
        return $airlineCompanyRepository->find($this->airlineCompanyId);
    }

    public static function fromRequest($request, $airlineCompanyId)
    {
        $request = json_decode($request);

        return new static(
            $airlineCompanyId,
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

    public function createAirplane(EntityManagerInterface $entityManagerInterface)
    {
        $this->airplane = new Airplane();

        $airlineCompanyRepository = $entityManagerInterface->getRepository(AirlineCompany::class);

        $this->airplane->setBrand($this->brand)
            ->setModel($this->model)
            ->setAirlineCompany($this->getAirlineCompany($airlineCompanyRepository));

        $entityManagerInterface->persist($this->airplane);
        $entityManagerInterface->flush();

        return $this->airplane;
    }

    public function getAirplane(AirplaneRepository $airplaneRepository)
    {
        return $airplaneRepository->find($this->airplaneId);
    }
}
