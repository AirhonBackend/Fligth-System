<?php

namespace App\Controller;

use App\Entity\Flight;
use App\Entity\FlightSeat;
use App\Entity\FlightSeatClasses;
use App\Repository\AirplaneRepository;
use App\Repository\DestinationRepository;
use App\Repository\FlightRepository;
use App\Repository\FlightSeatClassesRepository;
use App\Repository\FlightSeatRepository;
use App\Repository\PassengerRepository;
use App\Repository\TerminalRepository;
use App\Model\FlightModel;
use App\Model\FlightSeatModel;
use App\Resource\FlightResource;
use App\Resource\FlightSeatResource;
use GeneralApiResource;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FlightController extends AbstractController
{

    /**
     * @Route("/flight", name="index_flight", methods="GET")
     */

    public function index(FlightRepository $flightRepository): Response
    {
        return FlightResource::fromCollection($flightRepository->findAll());
    }

    /**
     * @Route("/flight/new", name="store_flight", methods="POST")
     */
    public function store(Request $request): Response
    {
        $payload = FlightModel::fromRequest($request->getContent());
        $flight = $payload->createFlight($this->getDoctrine()->getManager());
        $response = new FlightResource($flight);

        return $response->transform();
    }

    /**
     * @Route("/book/seat/{flightSeatId}", name="book_flight", methods="POST")
     * @param FlightSeat $flightSeatId
     */
    public function bookPassenger(string $flightSeatId, Request $request, FlightSeatRepository $flightSeatRepository): Response
    {
        $flightSeat = FlightSeatModel::fromRequest($request->getContent(), $flightSeatRepository->find($flightSeatId));
        $flightSeat = $flightSeat->bookFlight($this->getDoctrine()->getManager());
        $response = new FlightSeatResource($flightSeat);
        return $response->transform();
    }
}
