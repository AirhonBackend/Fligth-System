<?php

namespace App\Controller\Terminal;

use App\Entity\Terminal;
use App\Resource\TerminalResource;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ShowTerminalController extends AbstractController
{
    /**
     * @Route("/terminals/{id}", name="show_terminal", methods="GET")
     */

    public function __invoke(Terminal $terminal): JsonResponse
    {
        $response = new TerminalResource($terminal);

        return $response->toJson();
    }
}
