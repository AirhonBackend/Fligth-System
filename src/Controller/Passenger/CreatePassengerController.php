<?php

namespace App\Controller\Passenger;

use App\Controller\ApiBaseController;
use App\Model\PassengerModel;
use App\Repository\PassengerRepository;
use App\Resource\PassengerResource;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CreatePassengerController extends ApiBaseController
{
    /**
     * @Route("/passsengers", name="create_passengers", methods="POST")
     */
    public function __invoke(Request $request, PassengerRepository $passengerRepository): JsonResponse
    {
        $passengetDto = PassengerModel::fromRequest($request->getContent());
        $validation = $this->validator->validateDataObjects($passengetDto);

        if ($validation->fails()) {
            return $this->json(['errors' => $validation->getErrorMessages()], JsonResponse::HTTP_BAD_REQUEST);
        }

        $response = new PassengerResource($passengerRepository->save($passengetDto));

        return $response->toJson();
    }
}
