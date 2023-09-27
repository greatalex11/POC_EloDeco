<?php

namespace App\Repository;

use App\Entity\Partenaire;
use App\Entity\Projet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Partenaire>
 *
 * @method Partenaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Partenaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Partenaire[]    findAll()
 * @method Partenaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PartenaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Partenaire::class);
    }

//    /**
//     * @return Partenaire[] Returns an array of Partenaire objects
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

    /**
     * @param int $projet_id
     * @return Partenaire[]|null
     */
    public function findByProjet(Projet $projet): ?array
    {
        return $this->createQueryBuilder('p')
            ->join('p.projets', 'pr')
            ->andWhere('pr.id = :projet')
            ->setParameter('projet', $projet)
            ->getQuery()
            ->getResult();
    }
}
