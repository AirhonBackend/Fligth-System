<?php

namespace App\Repository;

use App\Entity\AirlineCompany;
use App\Model\AirlineCompanyModel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AirlineCompany|null find($id, $lockMode = null, $lockVersion = null)
 * @method AirlineCompany|null findOneBy(array $criteria, array $orderBy = null)
 * @method AirlineCompany[]    findAll()
 * @method AirlineCompany[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AirlineCompanyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AirlineCompany::class);
    }

    // /**
    //  * @return AirlineCompany[] Returns an array of AirlineCompany objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AirlineCompany
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function save(AirlineCompanyModel $airlineCompanyModel, AirlineCompany $airlineCompanyEntity = null)
    {
        $airlineCompany = new AirlineCompany();

        if ($airlineCompanyEntity) {
            $airlineCompany = $airlineCompanyEntity;
        }

        $airlineCompany->setCarrierName($airlineCompanyModel->carrierName)
            ->setHeadquarters($airlineCompanyModel->headQuarters);

        $this->getEntityManager()->persist($airlineCompany);
        $this->getEntityManager()->flush();

        return $airlineCompany;
    }
}
