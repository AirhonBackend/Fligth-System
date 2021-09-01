<?php

namespace App\Controller;

use App\Entity\Passenger;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class PasssengerController extends AbstractController
{
    /**
     * @Route("/passsenger/new", name="store_passenger")
     */
    public function store(Request $request): Response
    {
        $payload = json_decode($request->getContent());
        $entityManager = $this->getDoctrine()->getManager();

        $passenger = new Passenger();

        $passenger->setFirstName($payload->firstName)
            ->setMiddleName($payload->middleName ?? null)
            ->setLastName($payload->lastName)
            ->setAge($payload->age)
            ->setGender($payload->gender);

        $entityManager->persist($passenger);
        $entityManager->flush();

        return $this->json([
            'success'   =>  true,
            'message'   =>  'New Passenger',
            'data'      =>  [
                'firstName'     =>  $passenger->getFirstName(),
                'lastName'      =>  $passenger->getLastName(),
                'age'           =>  $passenger->getAge(),
                'gender'        =>  $passenger->getGender(),
            ]
        ]);
    }
}
