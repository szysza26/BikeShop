<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\CartItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CartItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method CartItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method CartItem[]    findAll()
 * @method CartItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CartItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CartItem::class);
    }

    public function findByUserIdAndBikeId(int $userId, int $bikeId): ?CartItem
    {
        $qb = $this->createQueryBuilder('c')
            ->join('c.user', 'u')
            ->join('c.bike', 'b')
            ->groupBy('c.id')
            ->where('u.id = :userId')
            ->andWhere('b.id = :bikeId')
            ->setParameter('userId', $userId)
            ->setParameter('bikeId', $bikeId);

        $query = $qb->getQuery();

        return $query->getOneOrNullResult();
    }

    public function save(CartItem $cartItem): void
    {
        $this->getEntityManager()->persist($cartItem);
        $this->getEntityManager()->flush();
    }

    public function remove(CartItem $cartItem): void
    {
        $this->getEntityManager()->remove($cartItem);
        $this->getEntityManager()->flush();
    }
}
