<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Joueur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @method Joueur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Joueur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Joueur[]    findAll()
 * @method Joueur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JoueurRepository extends ServiceEntityRepository
{
    /**
     * @var PaginatorInterface
     */
    private $paginator;

    public function __construct(ManagerRegistry $registry , PaginatorInterface $paginator)
    {
        parent::__construct($registry, Joueur::class);
        $this->paginator = $paginator;
    }


    public function findSearch(SearchData $data): PaginationInterface
    {
        $query = $this
            ->createQueryBuilder('j')
            ->orderBy('j.nom', 'ASC')
            ->select('j');
        if (!empty($data->searchBarre))
            $query = $query
                ->andWhere('j.nom LIKE :searchBarre')
                ->setParameter('searchBarre' , "%{$data->searchBarre}%");
        if (!empty($data->pro))
            $query = $query
                ->andWhere('j.pro = 1');
        $query = $query->getQuery();
        return $this->paginator->paginate(
            $query,
            $data->page,
            5
        );
    }
}
