<?php

namespace App\Repository;

use App\Entity\JoueurPoste;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method JoueurPoste|null find($id, $lockMode = null, $lockVersion = null)
 * @method JoueurPoste|null findOneBy(array $criteria, array $orderBy = null)
 * @method JoueurPoste[]    findAll()
 * @method JoueurPoste[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JoueurPosteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JoueurPoste::class);
    }

    // /**
    //  * @return JoueurPoste[] Returns an array of JoueurPoste objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?JoueurPoste
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
