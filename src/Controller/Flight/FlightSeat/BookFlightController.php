<?php

namespace App\Controller\Flight\FlightSeat;

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

class BookFlightController extends AbstractController
{
    /**
     * @Route("/flights/{id}/book", name="book_flight", methods="POST")
     */

    public function __invoke(Request $request, Flight $flight, FlightSeatRepository $flightSeatRepository, PassengerRepository $passengerRepository, FlightSeatClassesRepository $flightSeatClassesRepository, AirplaneRepository $airplaneRepository): JsonResponse
    {
        $payload = FlightSeatModel::fromRequest($request->getContent(), $flight);

        $passenger = $passengerRepository->find($payload->passengerId);
        $flightSeatClass = $flightSeatClassesRepository->find($payload->flightSeatClassId);
        $airplane = $airplaneRepository->find($payload->airplaneId);

        $response = new FlightSeatResource($flightSeatRepository->save($payload, $passenger, $flightSeatClass, $airplane));

        return $response->toJson();
    }
}
