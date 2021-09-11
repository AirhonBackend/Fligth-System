<?php

namespace App\Controller\FlightSeatClass;

use App\Repository\FlightSeatClassesRepository;
use App\Resource\FlightSeatClassesResource;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FlightSeatClassCollectionController extends AbstractController
{
    /**
     * @Route("/flight-seat-classes", name="collection_flight_seat_class", methods="GET")
     */

    public function __invoke(FlightSeatClassesRepository $flightSeatClassesRepository): JsonResponse
    {
        return FlightSeatClassesResource::fromCollection($flightSeatClassesRepository->findAll());
    }
}
