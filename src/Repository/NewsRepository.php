<?php

namespace App\Repository;

use App\Entity\News;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method News|null find($id, $lockMode = null, $lockVersion = null)
 * @method News|null findOneBy(array $criteria, array $orderBy = null)
 * @method News[]    findAll()
 * @method News[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NewsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, News::class);
    }

    public function findByFilters(array $filters): array
    {
        $qb = $this->createQueryBuilder('n');

        if(array_key_exists('offset', $filters) && $filters['offset']){
            $qb->setFirstResult($filters['offset']);
        }

        if(array_key_exists('count', $filters) && $filters['count']){
            $qb->setMaxResults($filters['count']);
        }

        $query = $qb->getQuery();

        return $query->execute();
    }

    public function countNews(): int
    {
        $qb = $this->createQueryBuilder('n')
            ->select('count(n.id)')
            ->groupBy('n.id');

        $query = $qb->getQuery();

        return count($query->execute());
    }
}
