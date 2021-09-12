<?php

namespace App\Controller\FlightSeatClass;

use App\Controller\ApiBaseController;
use App\Model\FlightSeatClassesModel;
use App\Repository\FlightSeatClassesRepository;
use App\Resource\FlightSeatClassesResource;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CreateFlightSeatClassController extends ApiBaseController
{
    /**
     * @Route("/flight-seat-classes", name="create_flight_seat_class", methods="POST")
     */
    public function __invoke(Request $request, FlightSeatClassesRepository $flightSeatClassesRepository): JsonResponse
    {
        $flightSeatClassDto = FlightSeatClassesModel::fromRequest($request->getContent());
        $validation = $this->validator->validateDataObjects($flightSeatClassDto);

        if ($validation->fails()) {
            return $this->json(['errors' => $validation->getErrorMessages()], JsonResponse::HTTP_BAD_REQUEST);
        }

        $response = new FlightSeatClassesResource($flightSeatClassesRepository->save($flightSeatClassDto));

        return $response->toJson();
    }
}
