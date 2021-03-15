<?php

namespace App\Repository;

use App\Entity\PostAlert;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PostAlert|null find($id, $lockMode = null, $lockVersion = null)
 * @method PostAlert|null findOneBy(array $criteria, array $orderBy = null)
 * @method PostAlert[]    findAll()
 * @method PostAlert[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostAlertRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PostAlert::class);
    }

    // /**
    //  * @return PostAlert[] Returns an array of PostAlert objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PostAlert
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
