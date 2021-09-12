<?php

namespace App\Repository;

use App\Entity\Airplane;
use App\Entity\FlightSeat;
use App\Entity\FlightSeatClasses;
use App\Entity\Passenger;
use App\Model\FlightSeatModel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FlightSeat|null find($id, $lockMode = null, $lockVersion = null)
 * @method FlightSeat|null findOneBy(array $criteria, array $orderBy = null)
 * @method FlightSeat[]    findAll()
 * @method FlightSeat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FlightSeatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FlightSeat::class);
    }

    public function save(FlightSeatModel $flightSeatModel, Passenger $passenger, FlightSeatClasses $flightSeatClasses, Airplane $airplane)
    {
        $flightSeat = new FlightSeat();

        $flightSeat->setNumber($flightSeatModel->seatNumber)
            ->setFlight($flightSeatModel->flight)
            ->setAirplane($airplane)
            ->setPassenger($passenger)
            ->setFlightSeatClass($flightSeatClasses)
            ->setStatus($flightSeatModel->status);

        $this->_em->persist($flightSeat);

        $flightSeat->getFlight()->decrementCapacity();

        $this->_em->flush();

        return $flightSeat;
    }
}
