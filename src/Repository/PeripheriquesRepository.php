<?php

namespace App\Repository;

use App\Entity\Peripheriques;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Peripheriques>
 *
 * @method Peripheriques|null find($id, $lockMode = null, $lockVersion = null)
 * @method Peripheriques|null findOneBy(array $criteria, array $orderBy = null)
 * @method Peripheriques[]    findAll()
 * @method Peripheriques[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PeripheriquesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Peripheriques::class);
    }

//    /**
//     * @return Peripheriques[] Returns an array of Peripheriques objects
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

//    public function findOneBySomeField($value): ?Peripheriques
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
