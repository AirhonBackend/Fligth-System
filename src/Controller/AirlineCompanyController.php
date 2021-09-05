<?php

namespace App\Controller;

use App\Entity\AirlineCompany;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AirlineCompanyController extends AbstractController
{


    
    /**
     * @Route("/airline/new", name="airline_company", methods="POST")
     */

    public function store(Request $request, ValidatorInterface $validator): Response
    {
        $payload = json_decode($request->getContent());
        $entityManager = $this->getDoctrine()->getManager();

        $airlineCompany = new AirlineCompany();

        $airlineCompany->setCarrierName($payload->carrierName)
            ->setHeadquarters($payload->headQuarters);

        $entityManager->persist($airlineCompany);
        $entityManager->flush();

        return $this->json([
            'success'   =>  true,
            'message'   =>  'New Airline Company',
            'data'      =>  [
                'carrierName'   =>  $airlineCompany->getCarrierName(),
                'headQuarters'   =>  $airlineCompany->getHeadQuarters(),
            ]
        ]);
    }
}
