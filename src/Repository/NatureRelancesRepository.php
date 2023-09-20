<?php

namespace App\Repository;

use App\Entity\NatureRelances;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NatureRelances>
 *
 * @method NatureRelances|null find($id, $lockMode = null, $lockVersion = null)
 * @method NatureRelances|null findOneBy(array $criteria, array $orderBy = null)
 * @method NatureRelances[]    findAll()
 * @method NatureRelances[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NatureRelancesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NatureRelances::class);
    }

//    /**
//     * @return NatureRelances[] Returns an array of NatureRelances objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('n.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?NatureRelances
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
