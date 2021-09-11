<?php

namespace App\Controller\FlightSeatClass;

use App\Model\FlightSeatClassesModel;
use App\Repository\FlightSeatClassesRepository;
use App\Resource\FlightSeatClassesResource;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateFlightSeatClassController extends AbstractController
{
    /**
     * @Route("/flight-seat-classes", name="create_flight_seat_class", methods="POST")
     */
    public function __invoke(Request $request, FlightSeatClassesRepository $flightSeatClassesRepository): JsonResponse
    {
        $payload = FlightSeatClassesModel::fromRequest($request->getContent());
        $response = new FlightSeatClassesResource($flightSeatClassesRepository->save($payload));

        return $response->toJson();
    }
}
