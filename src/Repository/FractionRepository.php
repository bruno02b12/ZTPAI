<?php

namespace App\Repository;

use App\Entity\Fraction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Fraction>
 *
 * @method Fraction|null find($id, $lockMode = null, $lockVersion = null)
 * @method Fraction|null findOneBy(array $criteria, array $orderBy = null)
 * @method Fraction[]    findAll()
 * @method Fraction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FractionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fraction::class);
    }

    //    /**
    //     * @return Fraction[] Returns an array of Fraction objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('f.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Fraction
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
