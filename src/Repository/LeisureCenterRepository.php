<?php

namespace App\Repository;

use App\Entity\LeisureCenter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LeisureCenter|null find($id, $lockMode = null, $lockVersion = null)
 * @method LeisureCenter|null findOneBy(array $criteria, array $orderBy = null)
 * @method LeisureCenter[]    findAll()
 * @method LeisureCenter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LeisureCenterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LeisureCenter::class);
    }

    // /**
    //  * @return LeisureCenter[] Returns an array of LeisureCenter objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LeisureCenter
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
