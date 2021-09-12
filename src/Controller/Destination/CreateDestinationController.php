<?php

namespace App\Controller\Destination;

use App\Controller\ApiBaseController;
use App\Model\DestinationModel;
use App\Repository\DestinationRepository;
use App\Resource\DestinationResource;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CreateDestinationController extends ApiBaseController
{
    /**
     * @Route("/destinations", name="create_destination", methods="POST")
     */
    public function __invoke(Request $request, DestinationRepository $destinationRepository): JsonResponse
    {
        $desinationdto = DestinationModel::fromRequest($request->getContent());

        $validation = $this->validator->validateDataObjects($desinationdto);

        if ($validation->fails()) {
            return $this->json(['errors' => $validation->getErrorMessages()], JsonResponse::HTTP_BAD_REQUEST);
        }

        $destination = new DestinationResource($destinationRepository->save($desinationdto));

        return $destination->toJson();
    }
}
