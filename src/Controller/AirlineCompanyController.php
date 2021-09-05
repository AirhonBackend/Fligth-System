<?php

namespace App\Controller;

use App\Entity\AirlineCompany;
use App\Model\AirlineCompanyModel;
use App\Repository\AirlineCompanyRepository;
use App\Resource\AirlineCompanyResource;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AirlineCompanyController extends AbstractController
{


    /**
     * @Route("/airline", name="index_airline_company", methods="GET")
     * @param AirlineCompany $airlineCompanyId
     */
    public function index(AirlineCompanyRepository $airlineCompanyRepository)
    {
        return AirlineCompanyResource::fromCollection($airlineCompanyRepository->findAll());
    }

    /**
     * @Route("/airline/new", name="airline_company", methods="POST")
     */

    public function store(Request $request, ValidatorInterface $validator): Response
    {
        $payload = AirlineCompanyModel::fromRequest($request->getContent());

        $airlineCompany = $payload->createAirlineCompany($this->getDoctrine()->getManager());

        $response = new AirlineCompanyResource($airlineCompany);

        return $response->transform();
    }
}
