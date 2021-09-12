<?php

namespace App\Controller\Flight\FlightSeat;

use App\Controller\ApiBaseController;
use App\Entity\Flight;
use App\Entity\Passenger;
use App\Model\FlightSeatModel;
use App\Repository\AirplaneRepository;
use App\Repository\FlightSeatClassesRepository;
use App\Repository\FlightSeatRepository;
use App\Repository\PassengerRepository;
use App\Resource\FlightResource;
use App\Resource\FlightSeatResource;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookFlightController extends ApiBaseController
{
    /**
     * @Route("/flights/{id}/book", name="book_flight", methods="POST")
     */

    public function __invoke(Request $request, Flight $flight, FlightSeatRepository $flightSeatRepository, PassengerRepository $passengerRepository, FlightSeatClassesRepository $flightSeatClassesRepository, AirplaneRepository $airplaneRepository): JsonResponse
    {
        $bookFlightDto = FlightSeatModel::fromRequest($request->getContent(), $flight);

        $validation = $this->validator->validateDataObjects($bookFlightDto);

        if ($validation->fails()) {
            return $this->json(['errors' => $validation->getErrorMessages()], JsonResponse::HTTP_BAD_REQUEST);
        }

        $passenger = $passengerRepository->find($bookFlightDto->passengerId);
        if (!$passenger) {
            return $this->json(['errors' => $this->notFoundErrorResponse('Passsenger')], JsonResponse::HTTP_NOT_FOUND);
        }

        $flightSeatClass = $flightSeatClassesRepository->find($bookFlightDto->flightSeatClassId);

        if (!$flightSeatClass) {
            return $this->json(['errors' => $this->notFoundErrorResponse('FlightSeatClass')], JsonResponse::HTTP_NOT_FOUND);
        }

        $airplane = $airplaneRepository->find($bookFlightDto->airplaneId);

        if (!$airplane) {
            return $this->json(['errors' => $this->notFoundErrorResponse('Airplane')], JsonResponse::HTTP_NOT_FOUND);
        }

        $response = new FlightSeatResource($flightSeatRepository->save($bookFlightDto, $passenger, $flightSeatClass, $airplane));
        return $response->toJson();
    }
}
