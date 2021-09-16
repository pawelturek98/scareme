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

    public function getStatistics(): array
    {
        $now = new \DateTime('now');
        $from = $now->modify('-13 days');

        $dates = $this->getDatesFromRange($from, new \DateTime('now'));
        $stats = [];

        // Dates are formatted by array generator
        foreach ($dates as $formatted_date) {
            $model = $this->findStatisticByDate($formatted_date);
            $stats[$formatted_date] = 0;

            if(isset($model[0])) {
                $stats[$formatted_date] = (int) $model[0][1];
            }
        }

        return $stats;
    }

    public function findStatisticByDate(string $formatted_date)
    {
        return $this->createQueryBuilder('vs')
            ->select('count(vs.id)')
            ->andWhere('vs.visited_at LIKE :val')
            ->setParameter('val', '%'.$formatted_date.'%')
            ->getQuery()
            ->getResult();
    }

    private function getDatesFromRange(\DateTime $from, \DateTime $to): array
    {
        $dates = [];
        $interval = new \DateInterval('P1D');
        $to->add($interval);

        $datePeriod = new \DatePeriod($from, $interval, $to);

        foreach ($datePeriod as $date) {
            $dates[] = $date->format('Y-m-d');
        }

        return $dates;
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
