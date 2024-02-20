<?php

namespace App\Repository;

use App\Entity\Boxs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Boxs>
 *
 * @method Boxs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Boxs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Boxs[]    findAll()
 * @method Boxs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BoxsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Boxs::class);
    }

//    /**
//     * @return Boxs[] Returns an array of Boxs objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Boxs
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
