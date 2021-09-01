<?php

namespace App\Controller;

use App\Entity\AirlineCompany;
use App\Entity\Airplane;
use App\Repository\AirlineCompanyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AirplaneController extends AbstractController
{
    /**
     * @Route("/airline/{airlineCompanyId}/airplane/new", name="store_airplane", methods="POST")
     * @param AirlineCompany $airlineCompanyId
     */
    public function store(string $airlineCompanyId, AirlineCompanyRepository $airlineCompanyRepository, Request $request)
    {
        $payload = json_decode($request->getContent());
        $airlineCompany = $airlineCompanyRepository->find($airlineCompanyId);

        $entityManager = $this->getDoctrine()->getManager();

        $airplane = new Airplane();

        $airplane->setBrand($payload->brand)
            ->setModel($payload->model)
            ->setAirlineCompany($airlineCompany);

        $entityManager->persist($airplane);
        $entityManager->flush();

        return $this->json([
            'success'   =>  true,
            'message'   =>  'New Aiplane Company',
            'data'      =>  [
                'brand'   =>  $airplane->getBrand(),
                'model'   =>  $airplane->getModel(),
                'airplaneCompany'   =>  [
                    'carrierName'   =>  $airplane->getAirlineCompany()->getCarrierName(),
                    'headQuarters'   =>  $airplane->getAirlineCompany()->getHeadQuarters()
                ],
            ]
        ]);
    }
}
