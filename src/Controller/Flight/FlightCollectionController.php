<?php

namespace App\Controller\Flight;

use App\Repository\FlightRepository;
use App\Resource\FlightResource;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class FlightCollectionController extends AbstractController
{
    /**
     * @Route("/flights", name="collection_flight", methods="GET")
     */

    public function __invoke(FlightRepository $flightRepository): JsonResponse
    {
        return FlightResource::fromCollection($flightRepository->findAll());
    }
}
