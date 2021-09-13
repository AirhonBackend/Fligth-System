<?php

namespace App\Controller\Terminal;

use App\Controller\ApiBaseController;
use App\Entity\Terminal;
use App\Model\TerminalModel;
use App\Repository\TerminalRepository;
use App\Resource\TerminalResource;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UpdateTerminalController extends ApiBaseController
{
    /**
     * @Route("/terminals/{id}", name="update_terminal", methods="PUT")
     */

    public function __invoke(Request $request, Terminal $terminal, TerminalRepository $terminalRepository): JsonResponse
    {
        $terminalDto = TerminalModel::fromRequest($request->getContent());

        $validation = $this->validator->validateDataObjects($terminalDto);

        if ($validation->fails()) {
            return $this->json(['errors' => $validation->getErrorMessages()], JsonResponse::HTTP_BAD_REQUEST);
        }

        $response = new TerminalResource($terminalRepository->save($terminalDto, $terminal));

        return $response->toJson();
    }
}
