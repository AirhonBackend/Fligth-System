<?php

namespace App\Controller\Airplane;

use App\Entity\Airplane;
use App\Resource\AirplaneResource;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShowAirplaneController extends AbstractController
{
    /**
     * @Route("airplanes/{id}", name="show_airplane", methods="GET")
     */
    public function __invoke(Airplane $airplane): JsonResponse
    {
        $response = new AirplaneResource($airplane);
        return $response->toJson();
    }
}
