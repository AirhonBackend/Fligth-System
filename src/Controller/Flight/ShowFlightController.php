<?php

namespace App\Controller\Flight;

use App\Entity\Flight;
use App\Resource\FlightResource;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShowFlightController extends AbstractController
{
    /**
     * @Route("/flights/{id}", name="showflight", methods="GET")
     */

    public function __invoke(Flight $flight): JsonResponse
    {
        $response = new FlightResource($flight);

        return $response->toJson();
    }
}
