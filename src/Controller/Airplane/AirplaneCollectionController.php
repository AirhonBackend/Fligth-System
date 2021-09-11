<?php

namespace App\Controller\Airplane;

use App\Repository\AirplaneRepository;
use App\Resource\AirplaneResource;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AirplaneCollectionController extends AbstractController
{
    /**
     * @Route("/airplanes", name="index_airplane", methods="GET")
     * @param AirlineCompany $airlineCompanyId
     */
    public function __invoke(AirplaneRepository $airplaneRepository): JsonResponse
    {
        return AirplaneResource::fromCollection($airplaneRepository->findAll());
    }
}
