<?php

namespace App\Repository;

use App\Entity\UserRecipeRating;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserRecipeRating>
 *
 * @method UserRecipeRating|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserRecipeRating|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserRecipeRating[]    findAll()
 * @method UserRecipeRating[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRecipeRatingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserRecipeRating::class);
    }

    //    /**
    //     * @return UserRecipeRating[] Returns an array of UserRecipeRating objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('u.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?UserRecipeRating
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
