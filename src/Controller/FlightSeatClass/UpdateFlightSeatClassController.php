<?php

namespace App\Controller\FlightSeatClass;

use App\Controller\ApiBaseController;
use App\Entity\FlightSeatClasses;
use App\Model\FlightSeatClassesModel;
use App\Repository\FlightSeatClassesRepository;
use App\Resource\FlightSeatClassesResource;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class UpdateFlightSeatClassController extends ApiBaseController
{
    /**
     * @Route("/flight-seat-classes/{id}", name="update_flight_seat_class", methods="PUT")
     */
    public function __invoke(Request $request, FlightSeatClasses $flightSeatClasses, FlightSeatClassesRepository $flightSeatClassesRepository): JsonResponse
    {
        $flightSeatClassDto = FlightSeatClassesModel::fromRequest($request->getContent());
        $validation = $this->validator->validateDataObjects($flightSeatClassDto);

        if ($validation->fails()) {
            return $this->json(['errors' => $validation->getErrorMessages()], JsonResponse::HTTP_BAD_REQUEST);
        }

        $response = new FlightSeatClassesResource($flightSeatClassesRepository->save($flightSeatClassDto, $flightSeatClasses));

        return $response->toJson();
    }
}
