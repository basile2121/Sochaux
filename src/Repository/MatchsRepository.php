<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Matchs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @method Matchs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Matchs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Matchs[]    findAll()
 * @method Matchs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MatchsRepository extends ServiceEntityRepository
{
    /**
     * @var PaginatorInterface
     */
    private $paginator;

    public function __construct(ManagerRegistry $registry , PaginatorInterface $paginator)
    {
        parent::__construct($registry, Matchs::class);
        $this->paginator = $paginator;
    }

    // /**
    //  * @return Matchs[] Returns an array of Matchs objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Matchs
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findSearch(SearchData $data):PaginationInterface
    {
        $query = $this
            ->createQueryBuilder('m')
            ->orderBy('m.date', 'DESC')
            ->select('m');
        if (!empty($data->dateMatch))
            $query = $query
                ->andWhere('m.date LIKE :dateMatch')
                ->setParameter('dateMatch' , "%{$data->dateMatch}%");
        if (!empty($data->equipe1))
            $query = $query
                ->join('m.participes' , 'p')
                ->join('p.clubfirst' , 'c11')
                ->join('p.clubsecond' , 'c12')
                ->andWhere('c11.nom_club LIKE :equipe1')
                ->orWhere('c12.nom_club LIKE :equipe1')
                ->setParameter('equipe1' , "%{$data->equipe1}%");
        if (!empty($data->equipe2))
            $query = $query
                ->join('m.participes' , 'pa')
                ->join('pa.clubfirst' , 'c21')
                ->join('pa.clubsecond' , 'c22')
                ->andWhere('c21.nom_club LIKE :equipe2')
                ->orWhere('c22.nom_club LIKE :equipe2')
                ->setParameter('equipe2' , "%{$data->equipe2}%");
        $query = $query->getQuery();
        return $this->paginator->paginate(
            $query,
            $data->page,
            5
        );
    }
}
