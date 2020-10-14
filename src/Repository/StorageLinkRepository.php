<?php

namespace App\Repository;

use App\Entity\StorageLink;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method StorageLink|null find($id, $lockMode = null, $lockVersion = null)
 * @method StorageLink|null findOneBy(array $criteria, array $orderBy = null)
 * @method StorageLink[]    findAll()
 * @method StorageLink[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StorageLinkRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StorageLink::class);
    }

    // /**
    //  * @return StorageLink[] Returns an array of StorageLink objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StorageLink
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
