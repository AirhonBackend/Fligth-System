<?php

namespace App\Controller\Flight;

use App\Model\FlightModel;
use App\Repository\FlightRepository;
use App\Resource\FlightResource;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CreateFlightController extends AbstractController
{
    /**
     * @Route("/flights", name="create_flight", methods="POST")
     */

    public function __invoke(Request $request, FlightRepository $flightRepository): JsonResponse
    {
        $payload = FlightModel::fromRequest($request->getContent());
        $response = new FlightResource($flightRepository->save($payload));
        return $response->toJson();
    }
}
