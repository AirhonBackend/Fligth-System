<?php

namespace App\Controller\AirlineCompany;

use App\Entity\AirlineCompany;
use App\Resource\AirlineCompanyResource;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ShowAirlineCompanyController extends AbstractController
{

    /**
     * @Route("/airlines/{id}", name="show_irline_company", methods="GET")
     */

    public function show(AirlineCompany $airlineCompany): JsonResponse
    {
        $response = new AirlineCompanyResource($airlineCompany);
        return $response->toJson();
    }
}
