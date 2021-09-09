<?php

namespace App\Resource;

use App\Entity\Airplane;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AirplaneResource extends BaseResourceDTO
{
    public int $id;

    public string $brand;

    public string $model;

    public AirlineCompanyResource $airplaneCompany;

    public function __construct(Airplane $airplane)
    {
        $this->id = $airplane->getId();
        $this->brand = $airplane->getBrand();
        $this->model = $airplane->getModel();
        $this->airplaneCompany = new AirlineCompanyResource($airplane->getAirlineCompany());

        $this->data = $this->allocateData();
    }

    private function allocateData()
    {
        return [
            'id'                =>  $this->id,
            'brand'             =>  $this->brand,
            'model'             =>  $this->model,
            'airplaneCompany'   =>  $this->airplaneCompany->data
        ];
    }
}
