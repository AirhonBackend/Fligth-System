<?php

namespace App\Controller\Terminal;

use App\Entity\Destination;
use App\Model\DestinationModel;
use App\Model\TerminalModel;
use App\Repository\TerminalRepository;
use App\Resource\TerminalResource;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CreateTerminalController extends AbstractController
{
    /**
     * @Route("destinations/{id}/terminals", name="create_terminal", methods="POST")
     */

    public function __invoke(Request $request, Destination $destination, TerminalRepository $terminalRepository): JsonResponse
    {
        $payload = TerminalModel::fromRequest($request->getContent(), $destination);
        $response = new TerminalResource($terminalRepository->save($payload));

        return $response->toJson();
    }
}
