<?php

namespace App\Controller;

use App\Entity\Flight;
use App\Entity\FlightSeat;
use App\Entity\FlightSeatClasses;
use App\Repository\AirplaneRepository;
use App\Repository\DestinationRepository;
use App\Repository\FlightSeatClassesRepository;
use App\Repository\FlightSeatRepository;
use App\Repository\PassengerRepository;
use App\Repository\TerminalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FlightController extends AbstractController
{
    /**
     * @Route("/flight/new", name="store_flight", methods="POST")
     */

    public function store(Request $request, DestinationRepository $destinationRepository, TerminalRepository $terminalRepository, AirplaneRepository $airplaneRepository): Response
    {
        $payload = json_decode($request->getContent());

        $destination = $destinationRepository->find($payload->destinationId);

        $terminal = $terminalRepository->find($payload->terminalId);

        $airplane = $airplaneRepository->find($payload->airplaneId);

        $entityManager = $this->getDoctrine()->getManager();

        $flight = new Flight();

        $flight->setDestination($destination)
            ->setTerminal($terminal)
            ->setCapacity($payload->capacity);

        $entityManager->persist($flight);


        foreach (range(1, $payload->capacity) as $seat) {
            $seat = new FlightSeat();
            $seat->setNumber('test')
                ->setFlight($flight)
                ->setAirplane($airplane)
                ->setStatus('available');

            $entityManager->persist($seat);
        }

        $entityManager->flush();

        return $this->json([
            'success'   =>  true,
            'message'   =>  'New flight has been created',
            'data'      =>  [
                'destination'       =>  [
                    'name'          =>  $flight->getDestination()->getName(),
                    'id'            =>  $flight->getDestination()->getId()
                ],
                'terminal'          =>  [
                    'name'          =>  $flight->getTerminal()->getName(),
                    'id'            =>  $flight->getTerminal()->getId()
                ],
                'seats'             =>  $flight->getFlightSeats()->getValues()
            ]
        ]);
    }

    /**
     * @Route("/book/seat/{flightSeatId}", name="book_flight", methods="POST")
     * @param FlightSeat $flightSeatId
     */
    public function bookPassenger(string $flightSeatId, Request $request, FlightSeatRepository $flightSeatRepository, PassengerRepository $passengerRepository, FlightSeatClassesRepository $flightSeatClassesRepository): Response
    {
        $payload = json_decode($request->getContent());
        $flightSeat = $flightSeatRepository->find($flightSeatId);

        $passenger = $passengerRepository->find($payload->passengerId);

        $flightSeatClass = $flightSeatClassesRepository->find($payload->flightSeatClassId);
        $entityManager = $this->getDoctrine()->getManager();

        $flightSeat->setPassenger($passenger)
            ->setFlightSeatClass($flightSeatClass)
            ->setStatus('occupied');

        $flightSeat->getFlight()->decrementCapacity();

        $entityManager->flush();

        return $this->json([
            'success'   =>  true,
            'message'   =>  'New passenger has been onboarded',
            'data'      =>  [
                'destination'   =>  [
                    'name'      =>  $flightSeat->getFlight()->getDestination()->getName()
                ],
                'passenger' =>  [
                    'firstName'    =>  $flightSeat->getPassenger()->getFirstName(),
                    'lastName'    =>  $flightSeat->getPassenger()->getLastName(),
                    'age'    =>  $flightSeat->getPassenger()->getAge(),
                    'gender'    =>  $flightSeat->getPassenger()->getGender(),
                ],
                'seatClass' =>  [
                    'name'  =>  $flightSeat->getFlightSeatClass()->getName()
                ],
                'airplane' =>  [
                    'model'  =>  $flightSeat->getAirplane()->getModel(),
                    'brand'  =>  $flightSeat->getAirplane()->getBrand(),
                ],
                'airplane' =>  [
                    'model'  =>  $flightSeat->getAirplane()->getModel(),
                    'brand'  =>  $flightSeat->getAirplane()->getBrand(),
                ],
            ]
        ]);
    }
}
