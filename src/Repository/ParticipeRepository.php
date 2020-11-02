<?php

namespace App\Repository;

use App\Entity\Participe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Participe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Participe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Participe[]    findAll()
 * @method Participe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParticipeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Participe::class);
    }

    // /**
    //  * @return Participe[] Returns an array of Participe objects
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
    public function findOneBySomeField($value): ?Participe
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
