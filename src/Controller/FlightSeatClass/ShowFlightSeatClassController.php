<?php

namespace App\Controller\FlightSeatClass;

use App\Entity\FlightSeatClasses;
use App\Resource\FlightSeatClassesResource;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShowFlightSeatClassController extends AbstractController
{
    /**
     * @Route("/flight-seat-classes/{id}", name="show_flight_seat_class", methods="GET")
     */
    public function __invoke(FlightSeatClasses $flightSeatClasses): JsonResponse
    {
        $response = new FlightSeatClassesResource($flightSeatClasses);

        return $response->toJson();
    }
}
