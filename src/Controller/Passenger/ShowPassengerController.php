<?php

namespace App\Controller\Passenger;

use App\Entity\Passenger;
use App\Resource\PassengerResource;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShowPassengerController extends AbstractController
{
    /**
     * @Route("/passsengers/{id}", name="show_passengers", methods="GET")
     */

    public function __invoke(Passenger $passenger): JsonResponse
    {
        $response = new PassengerResource($passenger);

        return $response->toJson();
    }
}
