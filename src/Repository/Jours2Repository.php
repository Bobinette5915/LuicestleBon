<?php

namespace App\Repository;

use App\Entity\Jours2;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Jours2>
 *
 * @method Jours2|null find($id, $lockMode = null, $lockVersion = null)
 * @method Jours2|null findOneBy(array $criteria, array $orderBy = null)
 * @method Jours2[]    findAll()
 * @method Jours2[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Jours2Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Jours2::class);
    }
 }

//    /**
//     * @return Jours2[] Returns an array of Jours2 objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('j.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Jours2
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

