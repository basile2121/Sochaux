<?php

namespace App\Repository;

use App\Entity\Tactique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tactique|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tactique|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tactique[]    findAll()
 * @method Tactique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TactiqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tactique::class);
    }

    // /**
    //  * @return Tactique[] Returns an array of Tactique objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Tactique
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
