<?php

namespace App\Controller;

use App\Entity\Destination;
use App\Entity\Terminal;
use App\Repository\DestinationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TerminalController extends AbstractController
{
    /**
     * @Route("destination/{destinationId}/terminal/new", name="store_terminal")
     * @param Destination $destinationId
     */

    public function store(string $destinationId, Request $request,  DestinationRepository $destinationRepository)
    {
        $payload = json_decode($request->getContent());
        $destination = $destinationRepository->find($destinationId);

        $entityManager = $this->getDoctrine()->getManager();

        $terminal = new Terminal();

        $terminal->setName($payload->name)
            ->setDestination($destination);


        $entityManager->persist($terminal);
        $entityManager->flush();

        return $this->json([
            'success'   =>  true,
            'message'   =>  'New airplane has been created',
            'data'      =>  [
                'name'   =>  $terminal->getName(),
                'destination'   =>  [
                    'name'   =>  $terminal->getDestination()->getName(),
                ],
            ]
        ]);
    }
}
