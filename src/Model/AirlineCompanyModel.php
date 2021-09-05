<?php

namespace App\Model;

use App\Entity\AirlineCompany;
use Doctrine\ORM\EntityManagerInterface;

class AirlineCompanyModel
{
    public $carrierName;

    public $headQuarters;

    public $airlineCompany;

    public function __construct(string $carrierName, string $headQuarters)
    {
        $this->carrierName = $carrierName;
        $this->headQuarters = $headQuarters;
    }

    public static function fromRequest($request)
    {
        $request = json_decode($request);

        return new static(
            $request->carrierName,
            $request->headQuarters
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
}
