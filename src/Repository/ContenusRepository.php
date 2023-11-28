<?php

namespace App\Repository;

use App\Entity\Contenus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Contenus>
 *
 * @method Contenus|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contenus|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contenus[]    findAll()
 * @method Contenus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContenusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contenus::class);
    }

    /**
     * @return Contenus[] Returns an array of Contenus objects
     */
    public function findByPagesName(string $pageName): array
    {
        return $this->createQueryBuilder('c')
            ->join("c.page", "p")
            ->andWhere('p.Nom = :nom')
            //->andWhere('p.published = :nom')
            ->setParameter('nom', $pageName)
            ->orderBy('c.date_creation', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

//    public function findOneBySomeField($value): ?Contenus
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
