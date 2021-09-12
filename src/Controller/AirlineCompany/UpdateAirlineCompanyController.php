<?php

namespace App\Controller\AirlineCompany;

use App\Controller\ApiBaseController;
use App\Entity\AirlineCompany;
use App\Model\AirlineCompanyModel;
use App\Repository\AirlineCompanyRepository;
use App\Resource\AirlineCompanyResource;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class UpdateAirlineCompanyController extends ApiBaseController
{
    /**
     * @Route("/airlines/{id}", name="update_irline_company", methods="PUT")
     */

    public function __invoke(Request $request, AirlineCompany $airlineCompany, AirlineCompanyRepository $airlineCompanyRepository)
    {
        $airlineDto = AirlineCompanyModel::fromRequest($request->getContent());
        $validation = $this->validator->validateDataObjects($airlineDto);
        if ($validation->fails()) {
            return $this->json(['errors' => $validation->getErrorMessages()], JsonResponse::HTTP_BAD_REQUEST);
        }
        $response = new AirlineCompanyResource($airlineCompanyRepository->save($airlineDto, $airlineCompany));
        return $response->toJson();
    }
}
