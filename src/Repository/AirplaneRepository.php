<?php

namespace App\Repository;

use App\Entity\Airplane;
use App\Model\AirplaneModel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Airplane|null find($id, $lockMode = null, $lockVersion = null)
 * @method Airplane|null findOneBy(array $criteria, array $orderBy = null)
 * @method Airplane[]    findAll()
 * @method Airplane[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AirplaneRepository extends ServiceEntityRepository
{
    // protected $manager;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Airplane::class);

        // $this->manager = $entityManagerInterface;
    }

    public function save(AirplaneModel $airplaneDto)
    {
        $airplane = new Airplane();

        $airplane->setBrand($airplaneDto->brand)
            ->setModel($airplaneDto->model)
            ->setAirlineCompany($airplaneDto->airlineCompany);

        $this->getEntityManager()->persist($airplane);
        $this->getEntityManager()->flush();

        return $airplane;
    }
}
