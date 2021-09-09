<?php

namespace App\Controller;

use App\Entity\AirlineCompany;
use App\Entity\Airplane;
use App\Model\AirplaneModel;
use App\Repository\AirlineCompanyRepository;
use App\Repository\AirplaneRepository;
use App\Resource\AirplaneResource;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AirplaneController extends AbstractController
{

    /**
     * @Route("/airline/{airlineCompanyId}/airplane", name="index_airplane", methods="GET")
     * @param AirlineCompany $airlineCompanyId
     */

    public function index(AirplaneRepository $airplaneRepository): Response
    {
        return AirplaneResource::fromCollection($airplaneRepository->findAll());
    }

    /**
     * @Route("/airline/{airlineCompanyId}/airplane/new", name="store_airplane", methods="POST")
     * @param AirlineCompany $airlineCompanyId
     */

    public function store(string $airlineCompanyId, AirlineCompanyRepository $airlineCompanyRepository, Request $request): Response
    {
        $payload = AirplaneModel::fromRequest($request->getContent(), $airlineCompanyId);
        $airplane = $payload->createAirplane($this->getDoctrine()->getManager());
        $response = new AirplaneResource($airplane);

        return $response->toJson();
    }

    /**
     * @Route("/airline/{airlineCompanyId}/airplane/{airplaneId}", name="show_airplane", methods="POST")
     */

    public function show(string $airlineCompanyId, string $airplaneId, Request $request)
    {
        $airplane = AirplaneModel::fromRequestUpdate($request, $airlineCompanyId, $airplaneId);

        $response = new AirplaneResource($airplane->getAirplane($this->getDoctrine()
            ->getManager()->getRepository(Airplane::class)));

        return $response->toJson();
    }
}
