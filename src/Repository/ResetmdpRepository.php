<?php

namespace App\Repository;

use App\Entity\Resetmdp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Resetmdp>
 *
 * @method Resetmdp|null find($id, $lockMode = null, $lockVersion = null)
 * @method Resetmdp|null findOneBy(array $criteria, array $orderBy = null)
 * @method Resetmdp[]    findAll()
 * @method Resetmdp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResetmdpRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Resetmdp::class);
    }

//    /**
//     * @return Resetmdp[] Returns an array of Resetmdp objects
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

//    public function findOneBySomeField($value): ?Resetmdp
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
