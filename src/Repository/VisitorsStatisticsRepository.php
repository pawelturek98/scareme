<?php

namespace App\Repository;

use App\Entity\VisitorsStatistics;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VisitorsStatistics|null find($id, $lockMode = null, $lockVersion = null)
 * @method VisitorsStatistics|null findOneBy(array $criteria, array $orderBy = null)
 * @method VisitorsStatistics[]    findAll()
 * @method VisitorsStatistics[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VisitorsStatisticsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VisitorsStatistics::class);
    }

    // /**
    //  * @return VisitorsStatistics[] Returns an array of VisitorsStatistics objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VisitorsStatistics
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
