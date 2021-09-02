<?php

namespace App\Repository;

use App\Entity\FlightSeatClasses;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FlightSeatClasses|null find($id, $lockMode = null, $lockVersion = null)
 * @method FlightSeatClasses|null findOneBy(array $criteria, array $orderBy = null)
 * @method FlightSeatClasses[]    findAll()
 * @method FlightSeatClasses[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FlightSeatClassesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FlightSeatClasses::class);
    }

    // /**
    //  * @return FlightSeatClasses[] Returns an array of FlightSeatClasses objects
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
    public function findOneBySomeField($value): ?FlightSeatClasses
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
