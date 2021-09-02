<?php

namespace App\Controller;

use App\Entity\Destination;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class DestinationController extends AbstractController
{
    /**
     * @Route("/destination/new", name="store_destination")
     */
    public function store(Request $request): Response
    {
        $payload = json_decode($request->getContent());
        $entityManager = $this->getDoctrine()->getManager();

        $destination = new Destination();

        $destination->setName($payload->name);

        $entityManager->persist($destination);
        $entityManager->flush();

        return $this->json([
            'success'   =>  true,
            'message'   =>  'New destination has been created',
            'data'      =>  [
                'name'     =>  $destination->getName(),
            ]
        ]);
    }
}
