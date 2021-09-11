<?php

namespace App\Controller\Destination;

use App\Entity\Destination;
use App\Resource\DestinationResource;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ShowDestinationController extends AbstractController
{
    /**
     * @Route("/destinations/{id}", name="show_destinations", methods="GET")
     */
    public function __invoke(Destination $destination): JsonResponse
    {
        $response = new DestinationResource($destination);

        return $response->toJson();
    }
}
