<?php

namespace App\Resource;

use App\Entity\AirlineCompany;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AirlineCompanyResource
{
    public $airlineCompany;

    public function __construct(AirlineCompany $airlineCompany)
    {
        $this->airlineCompany = $airlineCompany;
    }

    public function transform()
    {
        return new JsonResponse($this->allocateData());
    }

    public static function fromCollection($airlineCompanyCollection): Response
    {
        $collection = [];
        foreach ($airlineCompanyCollection as $airlineCompany) {
            $airlineCompanyData = new static($airlineCompany);

            $collection[] = $airlineCompanyData->allocateData();
        }

        return new JsonResponse($collection);
    }

    public function allocateData()
    {
        return [
            'carrierName'   =>  $this->airlineCompany->getCarrierName(),
            'headQuarters'   =>  $this->airlineCompany->getHeadQuarters(),
        ];
    }
}
