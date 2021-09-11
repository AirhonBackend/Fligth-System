<?php

namespace App\Controller\Destination;

use App\Model\DestinationModel;
use App\Repository\DestinationRepository;
use App\Resource\DestinationResource;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CreateDestinationController extends AbstractController
{
    /**
     * @Route("/destinations", name="create_destination", methods="POST")
     */
    public function __invoke(Request $request, DestinationRepository $destinationRepository): JsonResponse
    {
        $payload = DestinationModel::fromRequest($request->getContent());

        $destination = new DestinationResource($destinationRepository->save($payload));

        return $destination->toJson();
    }
}
