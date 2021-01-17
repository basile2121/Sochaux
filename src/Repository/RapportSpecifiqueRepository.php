<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\RapportSpecifique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @method RapportSpecifique|null find($id, $lockMode = null, $lockVersion = null)
 * @method RapportSpecifique|null findOneBy(array $criteria, array $orderBy = null)
 * @method RapportSpecifique[]    findAll()
 * @method RapportSpecifique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RapportSpecifiqueRepository extends ServiceEntityRepository
{
    /**
     * @var PaginatorInterface
     */
    private $paginator;

    public function __construct(ManagerRegistry $registry , PaginatorInterface $paginator)
    {
        parent::__construct($registry, RapportSpecifique::class);
        $this->paginator = $paginator;
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
    public function findSearch(SearchData $data):PaginationInterface
    {
        $query = $this
            ->createQueryBuilder('r')
            ->orderBy('r.dateRapport' , 'ASC')
            ->select('r');
        if (!empty($data->searchBarre))
            $query = $query
                ->join('r.joueur' , 'j')
                ->andWhere('j.nom LIKE :searchBarre')
                ->setParameter('searchBarre' , "%{$data->searchBarre}%");
        if (!empty($data->dateRapport))
            $query = $query
                ->andWhere('r.dateRapport LIKE :dateRapport')
                ->setParameter('dateRapport' , "%{$data->dateRapport}%");

        $query = $query->getQuery();
        return $this->paginator->paginate(
            $query,
            $data->page,
            5
        );
    }
}
