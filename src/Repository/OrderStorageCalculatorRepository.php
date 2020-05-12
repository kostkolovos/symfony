<?php

namespace App\Repository;

use App\Entity\OrderStorageCalculator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method OrderStorageCalculator|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderStorageCalculator|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderStorageCalculator[]    findAll()
 * @method OrderStorageCalculator[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderStorageCalculatorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderStorageCalculator::class);
    }

    // /**
    //  * @return OrderStorageCalculator[] Returns an array of OrderStorageCalculator objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OrderStorageCalculator
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
