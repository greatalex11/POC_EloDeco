<?php

namespace App\Repository;

use App\Entity\ModaliteContact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ModaliteContact>
 *
 * @method ModaliteContact|null find($id, $lockMode = null, $lockVersion = null)
 * @method ModaliteContact|null findOneBy(array $criteria, array $orderBy = null)
 * @method ModaliteContact[]    findAll()
 * @method ModaliteContact[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModaliteContactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ModaliteContact::class);
    }

//    /**
//     * @return ModaliteContact[] Returns an array of ModaliteContact objects
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

//    public function findOneBySomeField($value): ?ModaliteContact
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
