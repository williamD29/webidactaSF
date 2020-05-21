<?php

namespace App\Repository;

use App\Entity\GroupNumber;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GroupNumber|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroupNumber|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroupNumber[]    findAll()
 * @method GroupNumber[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupNumberRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GroupNumber::class);
    }

    // /**
    //  * @return GroupNumber[] Returns an array of GroupNumber objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GroupNumber
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
