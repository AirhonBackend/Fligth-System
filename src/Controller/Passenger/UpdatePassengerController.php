<?php

namespace App\Controller\Passenger;

use App\Controller\ApiBaseController;
use App\Entity\Passenger;
use App\Model\PassengerModel;
use App\Repository\PassengerRepository;
use App\Resource\PassengerResource;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class UpdatePassengerController extends ApiBaseController
{
    /**
     * @Route("/passsengers/{id}", name="update_passengers", methods="PUT")
     */
    public function __invoke(Request $request, Passenger $passenger, PassengerRepository $passengerRepository): JsonResponse
    {
        $passengetDto = PassengerModel::fromRequest($request->getContent());
        $validation = $this->validator->validateDataObjects($passengetDto);

        if ($validation->fails()) {
            return $this->json(['errors' => $validation->getErrorMessages()], JsonResponse::HTTP_BAD_REQUEST);
        }

        $response = new PassengerResource($passengerRepository->save($passengetDto, $passenger));

        return $response->toJson();
    }
}
