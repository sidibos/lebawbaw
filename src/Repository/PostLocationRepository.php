<?php

namespace App\Repository;

use App\Entity\PostLocation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PostLocation|null find($id, $lockMode = null, $lockVersion = null)
 * @method PostLocation|null findOneBy(array $criteria, array $orderBy = null)
 * @method PostLocation[]    findAll()
 * @method PostLocation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostLocationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PostLocation::class);
    }

    // /**
    //  * @return PostLocation[] Returns an array of PostLocation objects
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
    public function findOneBySomeField($value): ?PostLocation
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
