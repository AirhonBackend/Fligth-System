<?php

namespace App\Controller\Destination;

use App\Repository\DestinationRepository;
use App\Resource\DestinationResource;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class DestinationCollectionController extends AbstractController
{
    /**
     * @Route("/destinations", name="collection_destinations", methods="GET")
     */
    public function __invoke(DestinationRepository $destinationRepository): JsonResponse
    {
        return DestinationResource::fromCollection($destinationRepository->findAll());
    }
}
