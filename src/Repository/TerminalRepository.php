<?php

namespace App\Repository;

use App\Entity\Terminal;
use App\Model\TerminalModel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Terminal|null find($id, $lockMode = null, $lockVersion = null)
 * @method Terminal|null findOneBy(array $criteria, array $orderBy = null)
 * @method Terminal[]    findAll()
 * @method Terminal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TerminalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Terminal::class);
    }


    public function findByDestinationId($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.destination = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Terminal[] Returns an array of Terminal objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Terminal
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function save(TerminalModel $terminalModel, Terminal $terminalEntity = null)
    {
        $terminal = new Terminal();

        if ($terminalEntity) {
            $terminal = $terminalEntity;
        }

        $terminal->setName($terminalModel->name)
            ->setDestination($terminalModel->destination ?? $terminal->getDestination());

        $this->getEntityManager()->persist($terminal);
        $this->getEntityManager()->flush();

        return $terminal;
    }
}
