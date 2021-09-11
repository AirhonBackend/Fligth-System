<?php

namespace App\Controller\Passenger;

use App\Model\PassengerModel;
use App\Repository\PassengerRepository;
use App\Resource\PassengerResource;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreatePassengerController extends AbstractController
{
    /**
     * @Route("/passsengers", name="create_passengers", methods="POST")
     */
    public function __invoke(Request $request, PassengerRepository $passengerRepository): JsonResponse
    {
        $payload = PassengerModel::fromRequest($request->getContent());
        $response = new PassengerResource($passengerRepository->save($payload));

        return $response->toJson();
    }
}
