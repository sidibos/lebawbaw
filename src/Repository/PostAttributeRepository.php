<?php

namespace App\Repository;

use App\Entity\PostAttribute;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PostAttribute|null find($id, $lockMode = null, $lockVersion = null)
 * @method PostAttribute|null findOneBy(array $criteria, array $orderBy = null)
 * @method PostAttribute[]    findAll()
 * @method PostAttribute[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostAttributeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PostAttribute::class);
    }

    // /**
    //  * @return PostAttribute[] Returns an array of PostAttribute objects
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
    public function findOneBySomeField($value): ?PostAttribute
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
