<?php

namespace App\Controller\AirlineCompany;

use App\Model\AirlineCompanyModel;
use App\Repository\AirlineCompanyRepository;
use App\Resource\AirlineCompanyResource;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CreateAirlineCompanyController extends AbstractController
{

    /**
     * @Route("/airlines", name="create_airline_company", methods="POST")
     */
    public function __invoke(Request $request, AirlineCompanyRepository $airlineCompanyRepository): JsonResponse
    {
        $payload = AirlineCompanyModel::fromRequest($request->getContent());
        $response = new AirlineCompanyResource($airlineCompanyRepository->save($payload));
        return $response->toJson();
    }
}
