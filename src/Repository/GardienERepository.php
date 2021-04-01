<?php

namespace App\Repository;

use App\Entity\GardienE;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GardienE|null find($id, $lockMode = null, $lockVersion = null)
 * @method GardienE|null findOneBy(array $criteria, array $orderBy = null)
 * @method GardienE[]    findAll()
 * @method GardienE[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GardienERepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GardienE::class);
    }

    // /**
    //  * @return GardienE[] Returns an array of GardienE objects
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
    public function findOneBySomeField($value): ?GardienE
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
