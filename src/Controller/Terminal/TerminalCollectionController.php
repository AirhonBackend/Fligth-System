<?php

namespace App\Controller\Terminal;

use App\Repository\TerminalRepository;
use App\Resource\TerminalResource;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TerminalCollectionController extends AbstractController
{
    /**
     * @Route("/terminals", name="colelction_terminal", methods="GET")
     */
    public function __invoke(TerminalRepository $terminalRepository): JsonResponse
    {
        return TerminalResource::fromCollection($terminalRepository->findAll());
    }
}
