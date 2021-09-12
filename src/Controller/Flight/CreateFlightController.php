<?php

namespace App\Controller\Flight;

use App\Controller\ApiBaseController;
use App\Model\FlightModel;
use App\Repository\DestinationRepository;
use App\Repository\FlightRepository;
use App\Repository\TerminalRepository;
use App\Resource\FlightResource;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CreateFlightController extends ApiBaseController
{
    /**
     * @Route("/flights", name="create_flight", methods="POST")
     */

    public function __invoke(Request $request, FlightRepository $flightRepository, DestinationRepository $destinationRepository, TerminalRepository $terminalRepository): JsonResponse
    {
        $flightDto = FlightModel::fromRequest($request->getContent());
        $validation = $this->validator->validateDataObjects($flightDto);

        if ($validation->fails()) {
            return $this->json(['errors' => $validation->getErrorMessages()], JsonResponse::HTTP_BAD_REQUEST);
        }

        $destination = $destinationRepository->find($flightDto->destinationId);
        if (!$destination) {
            return $this->json(['errors' => $this->notFoundErrorResponse('Destination')], JsonResponse::HTTP_NOT_FOUND);
        }

        $terminal = $terminalRepository->find($flightDto->terminalId);
        if (!$terminal) {
            return $this->json(['errors' => $this->notFoundErrorResponse('Terminal')], JsonResponse::HTTP_NOT_FOUND);
        }

        $response = new FlightResource($flightRepository->save($flightDto, $destination, $terminal));
        return $response->toJson();
    }
}
