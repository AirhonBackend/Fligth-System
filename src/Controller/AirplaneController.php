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

    public function index(AirplaneRepository $airplaneRepository)
    {
        return AirplaneResource::fromCollection($airplaneRepository->findAll());
    }

    /**
     * @Route("/airline/{airlineCompanyId}/airplane/new", name="store_airplane", methods="POST")
     * @param AirlineCompany $airlineCompanyId
     */

    public function store(string $airlineCompanyId, AirlineCompanyRepository $airlineCompanyRepository, Request $request)
    {
        $payload = AirplaneModel::fromRequest($request->getContent(), $airlineCompanyId);
        $airplane = $payload->createAirplane($this->getDoctrine()->getManager());
        $response = new AirplaneResource($airplane);

        return $response->transform();
    }
}
