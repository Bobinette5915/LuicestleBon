<?php

namespace App\Repository;

use App\Entity\Personnalisation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Personnalisation>
 *
 * @method Personnalisation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Personnalisation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Personnalisation[]    findAll()
 * @method Personnalisation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonnalisationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Personnalisation::class);
    }

//    /**
//     * @return Personnalisation[] Returns an array of Personnalisation objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Personnalisation
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
