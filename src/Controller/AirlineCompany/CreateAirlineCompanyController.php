<?php

namespace App\Controller\AirlineCompany;

use App\Controller\ApiBaseController;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Model\AirlineCompanyModel;
use App\Repository\AirlineCompanyRepository;
use App\Resource\AirlineCompanyResource;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CreateAirlineCompanyController extends ApiBaseController
{

    /**
     * @Route("/airlines", name="create_airline_company", methods="POST")
     */
    public function __invoke(Request $request, AirlineCompanyRepository $airlineCompanyRepository, ValidatorInterface $validator): JsonResponse
    {
        $airlineDto = AirlineCompanyModel::fromRequest($request->getContent());
        $validation = $this->validator->validateDataObjects($airlineDto);
        if ($validation->fails()) {
            return $this->json(['errors' => $validation->getErrorMessages()], JsonResponse::HTTP_BAD_REQUEST);
        }
        $response = new AirlineCompanyResource($airlineCompanyRepository->save($airlineDto));
        return $response->toJson();
    }
}
