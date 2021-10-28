<?php

namespace App\Repository;

use App\Entity\BikePhoto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BikePhoto|null find($id, $lockMode = null, $lockVersion = null)
 * @method BikePhoto|null findOneBy(array $criteria, array $orderBy = null)
 * @method BikePhoto[]    findAll()
 * @method BikePhoto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BikePhotoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BikePhoto::class);
    }

    // /**
    //  * @return BikePhoto[] Returns an array of BikePhoto objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BikePhoto
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
