<?php

namespace App\Controller;

use App\Entity\FlightSeatClasses;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FlightSeatClassesController extends AbstractController
{
    /**
     * @Route("/flight-seat-class/new", name="store_flight_seat_class", methods="POST")
     */

    public function store(Request $request)
    {
        $payload = json_decode($request->getContent());

        $entityManager = $this->getDoctrine()->getManager();

        $flightSeatClass = new FlightSeatClasses();

        $flightSeatClass->setName($payload->name);

        $entityManager->persist($flightSeatClass);
        $entityManager->flush();

        return $this->json([
            'success'   =>  true,
            'message'   =>  'New flight seat class has been created',
            'data'      =>  [
                'name'   =>  $flightSeatClass->getName(),
            ]
        ]);
    }
}
