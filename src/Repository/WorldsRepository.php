<?php

namespace App\Repository;

use App\Entity\Worlds;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Worlds>
 *
 * @method Worlds|null find($id, $lockMode = null, $lockVersion = null)
 * @method Worlds|null findOneBy(array $criteria, array $orderBy = null)
 * @method Worlds[]    findAll()
 * @method Worlds[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorldsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Worlds::class);
    }

//    /**
//     * @return Worlds[] Returns an array of Worlds objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('w.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Worlds
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
