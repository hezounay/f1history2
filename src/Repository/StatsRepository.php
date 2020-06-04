<?php

namespace App\Repository;

use App\Entity\Stats;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Stats|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stats|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stats[]    findAll()
 * @method Stats[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stats::class);
    }

    public function myOrderStats($slug, $order){
        return $this->createQueryBuilder('s')
                    ->join('s.grandPrix','g')
                    ->andWhere('g.slug = :myslug')
                    ->setParameter('myslug', $slug)
                    ->orderBy('s.chrono', $order)
                    ->getQuery()
                    ->getResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?Stats
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
