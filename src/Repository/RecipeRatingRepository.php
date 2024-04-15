<?php

namespace App\Repository;

use App\Entity\RecipeRating;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RecipeRating>
 *
 * @method RecipeRating|null find($id, $lockMode = null, $lockVersion = null)
 * @method RecipeRating|null findOneBy(array $criteria, array $orderBy = null)
 * @method RecipeRating[]    findAll()
 * @method RecipeRating[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecipeRatingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RecipeRating::class);
    }

    //    /**
    //     * @return RecipeRating[] Returns an array of RecipeRating objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('r.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?RecipeRating
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
