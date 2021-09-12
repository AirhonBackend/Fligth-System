<?php

namespace App\Controller\Terminal;

use App\Controller\ApiBaseController;
use App\Entity\Destination;
use App\Model\DestinationModel;
use App\Model\TerminalModel;
use App\Repository\TerminalRepository;
use App\Resource\TerminalResource;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CreateTerminalController extends ApiBaseController
{
    /**
     * @Route("destinations/{id}/terminals", name="create_terminal", methods="POST")
     */

    public function __invoke(Request $request, Destination $destination, TerminalRepository $terminalRepository): JsonResponse
    {
        $terminalDto = TerminalModel::fromRequest($request->getContent(), $destination);

        $validation = $this->validator->validateDataObjects($terminalDto);

        if ($validation->fails()) {
            return $this->json(['errors' => $validation->getErrorMessages()], JsonResponse::HTTP_BAD_REQUEST);
        }

        $response = new TerminalResource($terminalRepository->save($terminalDto));

        return $response->toJson();
    }
}
