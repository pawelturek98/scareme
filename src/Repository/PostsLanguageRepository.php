<?php

namespace App\Repository;

use App\Entity\PostsLanguage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PostsLanguage|null find($id, $lockMode = null, $lockVersion = null)
 * @method PostsLanguage|null findOneBy(array $criteria, array $orderBy = null)
 * @method PostsLanguage[]    findAll()
 * @method PostsLanguage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostsLanguageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PostsLanguage::class);
    }

    // /**
    //  * @return PostsLanguage[] Returns an array of PostsLanguage objects
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
    public function findOneBySomeField($value): ?PostsLanguage
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
