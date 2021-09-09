<?php

namespace App\Controller;

use App\Entity\Destination;
use App\Model\DestinationModel;
use App\Repository\DestinationRepository;
use App\Resource\DestinationResource;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class DestinationController extends AbstractController
{
    /**
     * @Route("/destination", name="index_destination", methods="GET")
     */
    public function index(DestinationRepository $destinationRepository)
    {
        return DestinationResource::fromCollection($destinationRepository->findAll());
    }

    /**
     * @Route("/destination/new", name="store_destination")
     */
    public function store(Request $request): Response
    {
        $payload = DestinationModel::fromRequest($request->getContent());
        $destination = $payload->createDestination($this->getDoctrine()->getManager());

        $response = new DestinationResource($destination);

        return $response->toJson();
    }
}
