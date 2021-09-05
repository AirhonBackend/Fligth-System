<?php

namespace App\Model;

use App\Entity\AirlineCompany;
use App\Entity\Airplane;
use App\Repository\AirlineCompanyRepository;
use Doctrine\ORM\EntityManagerInterface;

class AirplaneModel
{
    public $airlineCompanyId;

    public $brand;

    public $model;

    public $airplane;

    public function __construct(int $airlineCompanyId, string $brand, string $model)
    {
        $this->airlineCompanyId = $airlineCompanyId;
        $this->brand = $brand;
        $this->model = $model;
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
}
