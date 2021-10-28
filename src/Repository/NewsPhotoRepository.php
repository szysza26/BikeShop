<?php

namespace App\Repository;

use App\Entity\NewsPhoto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NewsPhoto|null find($id, $lockMode = null, $lockVersion = null)
 * @method NewsPhoto|null findOneBy(array $criteria, array $orderBy = null)
 * @method NewsPhoto[]    findAll()
 * @method NewsPhoto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NewsPhotoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NewsPhoto::class);
    }

    // /**
    //  * @return NewsPhoto[] Returns an array of NewsPhoto objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NewsPhoto
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
