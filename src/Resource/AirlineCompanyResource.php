<?php

namespace App\Resource;

use App\Entity\AirlineCompany;


class AirlineCompanyResource extends BaseResourceDTO
{
    public int $id;

    public string $carrierName;

    public string $headQuarters;

    public function __construct(AirlineCompany $airlineCompany)
    {
        $this->id = $airlineCompany->getId();
        $this->carrierName = $airlineCompany->getCarrierName();
        $this->headQuarters = $airlineCompany->getHeadquarters();

        $this->data = $this->allocateData();
    }

    private function allocateData()
    {
        return [
            'id'            =>  $this->id,
            'carrierName'   =>  $this->carrierName,
            'headQuarters'  =>  $this->headQuarters
        ];
    }
}
