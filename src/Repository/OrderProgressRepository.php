<?php

namespace App\Repository;

use App\Entity\OrderProgress;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method OrderProgress|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderProgress|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderProgress[]    findAll()
 * @method OrderProgress[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderProgressRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderProgress::class);
    }

    // /**
    //  * @return OrderProgress[] Returns an array of OrderProgress objects
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
    public function findOneBySomeField($value): ?OrderProgress
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
