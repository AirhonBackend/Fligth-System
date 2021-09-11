<?php

namespace App\Controller\AirlineCompany;

use App\Repository\AirlineCompanyRepository;
use App\Resource\AirlineCompanyResource;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AirlineCompanyCollectionController extends AbstractController
{
    /**
     * @Route("/airlines", name="collection_airline_company", methods="GET")
     */
    public function __invoke(AirlineCompanyRepository $airlineCompanyRepository): JsonResponse
    {
        return AirlineCompanyResource::fromCollection($airlineCompanyRepository->findAll());
    }
}
