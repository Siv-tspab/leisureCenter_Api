<?php

namespace App\Repository;

use App\Entity\LeisureCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LeisureCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method LeisureCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method LeisureCategory[]    findAll()
 * @method LeisureCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LeisureCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LeisureCategory::class);
    }

    // /**
    //  * @return LeisureCategory[] Returns an array of LeisureCategory objects
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
    public function findOneBySomeField($value): ?LeisureCategory
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
