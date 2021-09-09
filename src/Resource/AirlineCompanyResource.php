<?php

namespace App\Resource;

use App\Entity\AirlineCompany;


class AirlineCompanyResource extends BaseResourceDTO
{
    public string $carrierName;

    public string $headQuarters;

    public function __construct(AirlineCompany $airlineCompany)
    {
        $this->carrierName = $airlineCompany->getCarrierName();
        $this->headQuarters = $airlineCompany->getHeadquarters();

        $this->data = [
            'carrierName'   =>  $this->carrierName,
            'headQuarters'   =>  $this->headQuarters
        ];
    }
}
