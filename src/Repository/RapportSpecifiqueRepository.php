<?php

namespace App\Repository;

use App\Entity\RapportSpecifique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RapportSpecifique|null find($id, $lockMode = null, $lockVersion = null)
 * @method RapportSpecifique|null findOneBy(array $criteria, array $orderBy = null)
 * @method RapportSpecifique[]    findAll()
 * @method RapportSpecifique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RapportSpecifiqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RapportSpecifique::class);
    }

    // /**
    //  * @return RapportSpecifique[] Returns an array of RapportSpecifique objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RapportSpecifique
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
