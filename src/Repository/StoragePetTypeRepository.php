<?php

namespace App\Repository;

use App\Entity\StoragePetType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method StoragePetType|null find($id, $lockMode = null, $lockVersion = null)
 * @method StoragePetType|null findOneBy(array $criteria, array $orderBy = null)
 * @method StoragePetType[]    findAll()
 * @method StoragePetType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StoragePetTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StoragePetType::class);
    }

    // /**
    //  * @return StoragePetType[] Returns an array of StoragePetType objects
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
    public function findOneBySomeField($value): ?StoragePetType
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
