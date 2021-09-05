<?php

namespace App\Controller;

use App\Entity\Destination;
use App\Entity\Terminal;
use App\Model\TerminalModel;
use App\Repository\DestinationRepository;
use App\Repository\TerminalRepository;
use App\Resource\TerminalResource;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TerminalController extends AbstractController
{
    /**
     * @Route("destination/{destinationId}/terminal", name="index_terminal")
     * @param Destination $destinationId
     */
    public function index(string $destinationId, TerminalRepository $terminalRepository)
    {
        return TerminalResource::fromCollection($terminalRepository->findByDestinationId($destinationId));
    }
    /**
     * @Route("destination/{destinationId}/terminal/new", name="store_terminal")
     * @param Destination $destinationId
     */

    public function store(string $destinationId, Request $request,  DestinationRepository $destinationRepository)
    {
        $payload = TerminalModel::fromRequest($request->getContent(), $destinationId);

        $terminal = $payload->createTerminal($this->getDoctrine()->getManager());

        $response = new TerminalResource($terminal);

        return $response->transform();
    }
}
