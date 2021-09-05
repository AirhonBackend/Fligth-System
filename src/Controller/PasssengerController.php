<?php

namespace App\Controller;

use App\Entity\Passenger;
use App\Model\PassengerModel;
use App\Repository\PassengerRepository;
use App\Resource\PassengerResource;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class PasssengerController extends AbstractController
{
    /**
     * @Route("/passsenger", name="index_passenger")
     */
    public function index(PassengerRepository $passengerRepository): Response
    {
        return PassengerResource::fromCollection($passengerRepository->findAll());
    }
    /**
     * @Route("/passsenger/new", name="store_passenger")
     */
    public function store(Request $request): Response
    {
        $payload = PassengerModel::fromRequest($request->getContent());

        $passenger = $payload->createPassenger($this->getDoctrine()->getManager());

        $response = new PassengerResource($passenger);

        return $response->transform();
    }
}
