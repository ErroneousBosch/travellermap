<?php

namespace App\Repository;

use App\Entity\Sophont;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Sophont>
 *
 * @method Sophont|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sophont|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sophont[]    findAll()
 * @method Sophont[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SophontRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sophont::class);
    }

//    /**
//     * @return Sophont[] Returns an array of Sophont objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Sophont
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
