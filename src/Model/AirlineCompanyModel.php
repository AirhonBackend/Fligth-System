<?php

namespace App\Model;

use App\Entity\AirlineCompany;
use App\Repository\AirlineCompanyRepository;
use Doctrine\ORM\EntityManagerInterface;

class AirlineCompanyModel
{
    public $carrierName;

    public $headQuarters;

    public $airlineCompany;

    public $airlineCompanyId;

    public function __construct(string $carrierName = null, string $headQuarters = null, int $airlineCompanyId = null)
    {
        $this->carrierName = $carrierName;
        $this->headQuarters = $headQuarters;
        $this->airlineCompanyId = $airlineCompanyId;
    }

    public static function fromRequest($request)
    {
        $request = json_decode($request);

        return new static(
            $request->carrierName,
            $request->headQuarters
        );
    }

    public static function fromRequestUpdate($request, $airlineCompanyId)
    {
        $request = json_decode($request);

        return new static(
            $request->carrierName ?? null,
            $request->headQuarters ?? null,
            $airlineCompanyId
        );
    }

    public function createAirlineCompany(EntityManagerInterface $entityManagerInterface)
    {
        $this->airlineCompany = new AirlineCompany();

        $this->airlineCompany->setCarrierName($this->carrierName)
            ->setHeadquarters($this->headQuarters);


        $entityManagerInterface->persist($this->airlineCompany);
        $entityManagerInterface->flush();

        return $this->airlineCompany;
    }

    public function getAirlineCompany(AirlineCompanyRepository $airlineCompanyRepository)
    {
        return $airlineCompanyRepository->find($this->airlineCompanyId);
    }
}
