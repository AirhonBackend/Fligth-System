<?php

namespace App\Controller\Airplane;

use App\Controller\ApiBaseController;
use App\Entity\Airplane;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Model\AirplaneModel;
use App\Repository\AirplaneRepository;
use App\Resource\AirplaneResource;
use Symfony\Component\HttpFoundation\JsonResponse;

class UpdateAirplaneController extends ApiBaseController
{
    /**
     * @Route("/airplanes/{id}", name="update_airplane", methods="PUT")
     */

    public function __invoke(Request $request, Airplane $airplane, AirplaneRepository $airplaneRepository): JsonResponse
    {
        $airplaneDto = AirplaneModel::fromRequest($request->getContent());
        $validation = $this->validator->validateDataObjects($airplaneDto);

        if ($validation->fails()) {
            return $this->json(['errors' => $validation->getErrorMessages()], JsonResponse::HTTP_BAD_REQUEST);
        }

        $response = new AirplaneResource($airplaneRepository->save($airplaneDto, $airplane));
        return $response->toJson();
    }
}
