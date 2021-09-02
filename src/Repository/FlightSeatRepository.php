<?php

namespace App\Repository;

use App\Entity\FlightSeat;
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

    // /**
    //  * @return FlightSeat[] Returns an array of FlightSeat objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FlightSeat
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
