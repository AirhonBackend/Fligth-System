<?php

namespace App\Controller\Passenger;

use App\Repository\PassengerRepository;
use App\Resource\PassengerResource;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PassengerCollectionController extends AbstractController
{
    /**
     * @Route("/passsengers", name="collection_passenger", methods="GET")
     */

    public function __invoke(PassengerRepository $passengerRepository): JsonResponse
    {
        return PassengerResource::fromCollection($passengerRepository->findAll());
    }
}
