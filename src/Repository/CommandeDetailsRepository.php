<?php

namespace App\Repository;

use App\Entity\CommandeDetails;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CommandeDetails>
 *
 * @method CommandeDetails|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommandeDetails|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommandeDetails[]    findAll()
 * @method CommandeDetails[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeDetailsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommandeDetails::class);
    }

//    /**
//     * @return CommandeDetails[] Returns an array of CommandeDetails objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CommandeDetails
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
