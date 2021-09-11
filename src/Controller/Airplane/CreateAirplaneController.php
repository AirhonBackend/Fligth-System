<?php

namespace App\Controller\Airplane;

use App\Entity\AirlineCompany;
use App\Model\AirplaneModel;
use App\Repository\AirplaneRepository;
use App\Resource\AirplaneResource;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CreateAirplaneController extends AbstractController
{
    /**
     * @Route("/airlines/{id}/airplanes", name="store_airplane", methods="POST")
     */

    public function __invoke(Request $request, AirlineCompany $airlineCompany, AirplaneRepository $airplaneRepository): JsonResponse
    {
        $airplaneDto = AirplaneModel::fromRequest($request->getContent(), $airlineCompany);
        $response = new AirplaneResource($airplaneRepository->save($airplaneDto));
        return $response->toJson();
    }
}
