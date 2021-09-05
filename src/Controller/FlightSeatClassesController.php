<?php

namespace App\Controller;

use App\Entity\FlightSeatClasses;
use App\Model\FlightSeatClassesModel;
use App\Repository\FlightSeatClassesRepository;
use App\Resource\FlightResource;
use App\Resource\FlightSeatClassesResource;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FlightSeatClassesController extends AbstractController
{
    /**
     * @Route("/flight-seat-class", name="index_flight_seat_class", methods="GET")
     */

    public function index(FlightSeatClassesRepository $flightSeatClassesRepository)
    {
        return FlightSeatClassesResource::fromCollection($flightSeatClassesRepository->findAll());
    }

    /**
     * @Route("/flight-seat-class/new", name="store_flight_seat_class", methods="POST")
     */
    public function store(Request $request)
    {
        $payload = FlightSeatClassesModel::fromRequest($request->getContent());

        $flightSeatClass = $payload->createFlightSeatClass($this->getDoctrine()->getManager());

        $response = new FlightSeatClassesResource($flightSeatClass);

        return $response->transform();
    }
}
