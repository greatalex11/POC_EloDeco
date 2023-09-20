<?php

namespace App\Repository;

use App\Entity\ModamiteContact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ModamiteContact>
 *
 * @method ModamiteContact|null find($id, $lockMode = null, $lockVersion = null)
 * @method ModamiteContact|null findOneBy(array $criteria, array $orderBy = null)
 * @method ModamiteContact[]    findAll()
 * @method ModamiteContact[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModamiteContactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ModamiteContact::class);
    }

//    /**
//     * @return ModamiteContact[] Returns an array of ModamiteContact objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ModamiteContact
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
