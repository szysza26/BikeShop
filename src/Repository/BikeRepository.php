<?php

namespace App\Repository;

use App\Entity\Bike;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Bike|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bike|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bike[]    findAll()
 * @method Bike[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BikeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bike::class);
    }

    public function findByFilters(array $filters): array
    {
        $qb = $this->createQueryBuilder('b')
            ->addSelect('c')
            ->join('b.category', 'c')
            ->groupBy('b.id');

        if(array_key_exists('offset', $filters) && $filters['offset']){
            $qb->setFirstResult($filters['offset']);
        }

        if(array_key_exists('count', $filters) && $filters['count']){
            $qb->setMaxResults($filters['count']);
        }

        if(array_key_exists('category', $filters) && $filters['category']){
            $qb->andWhere('c.name = :category')
                ->setParameter('category', $filters['category']);
        }

        $query = $qb->getQuery();

        return $query->execute();
    }

    public function countByFilters(array $filters): int
    {
        $qb = $this->createQueryBuilder('b')
            ->select('count(b.id)')
            ->join('b.category', 'c')
            ->groupBy('b.id');

        if(array_key_exists('category', $filters) && $filters['category']){
            $qb->andWhere('c.name = :category')
                ->setParameter('category', $filters['category']);
        }

        $query = $qb->getQuery();

        return count($query->execute());
    }
}
