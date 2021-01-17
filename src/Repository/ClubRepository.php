<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Club;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @method Club|null find($id, $lockMode = null, $lockVersion = null)
 * @method Club|null findOneBy(array $criteria, array $orderBy = null)
 * @method Club[]    findAll()
 * @method Club[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClubRepository extends ServiceEntityRepository
{
    /**
     * @var PaginatorInterface
     */
    private $paginator;

    public function __construct(ManagerRegistry $registry , PaginatorInterface $paginator)
    {
        parent::__construct($registry, Club::class);
        $this->paginator = $paginator;
    }

    // /**
    //  * @return Club[] Returns an array of Club objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Club
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findSearch(SearchData $data): PaginationInterface
    {
        $query = $this
            ->createQueryBuilder('c')
            ->orderBy('c.nom_club' , 'ASC')
            ->select('c');
        if (!empty($data->searchBarre))
            $query = $query
                ->andWhere('c.nom_club LIKE :searchBarre')
                ->setParameter('searchBarre' , "%{$data->searchBarre}%");
        $query = $query->getQuery();
        return $this->paginator->paginate(
            $query,
            $data->page,
            5
        );
    }
}
