<?php

namespace App\Controller\Airplane;

use App\Controller\ApiBaseController;
use App\Entity\AirlineCompany;
use App\Model\AirplaneModel;
use App\Repository\AirplaneRepository;
use App\Resource\AirplaneResource;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CreateAirplaneController extends ApiBaseController
{
    /**
     * @Route("/airlines/{id}/airplanes", name="store_airplane", methods="POST")
     */

    public function __invoke(Request $request, AirlineCompany $airlineCompany, AirplaneRepository $airplaneRepository): JsonResponse
    {
        $airplaneDto = AirplaneModel::fromRequest($request->getContent(), $airlineCompany);
        $validation = $this->validator->validateDataObjects($airplaneDto);

        if ($validation->fails()) {
            return $this->json(['errors' => $validation->getErrorMessages()], JsonResponse::HTTP_BAD_REQUEST);
        }

        $response = new AirplaneResource($airplaneRepository->save($airplaneDto));
        return $response->toJson();
    }
}
