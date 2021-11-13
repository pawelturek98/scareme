<?php

namespace App\Repository;

use App\Entity\PageSettings;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PageSettings|null find($id, $lockMode = null, $lockVersion = null)
 * @method PageSettings|null findOneBy(array $criteria, array $orderBy = null)
 * @method PageSettings[]    findAll()
 * @method PageSettings[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PageSettingsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PageSettings::class);
    }

    public function getSettings(): ?PageSettings
    {
        try {
            return $this->createQueryBuilder('s')
                ->where('s.id = :val')
                ->setParameter('val', 1)
                ->setMaxResults(1)
                ->getQuery()
                ->getSingleResult();
        } catch (NoResultException $e) {
            return null;
        }
    }

    // /**
    //  * @return PageSettings[] Returns an array of PageSettings objects
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
    public function findOneBySomeField($value): ?PageSettings
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
