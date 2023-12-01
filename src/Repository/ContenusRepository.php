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


// -------------------------------------------------------------------------------------------------  Home Ma Selection
    public function findByPagesName(string $pageName): array
    {
        return $this->createQueryBuilder('c')
            ->join("c.pages", "p")
            ->andWhere('p.nom = :nom')
            ->andWhere('c.publier = 1')
            ->andWhere('c.type in (:types)')
            ->setParameter('nom', $pageName)
//            ->setParameter('types', $types)
            ->orderBy('c.createdAt', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

// -------------------------------------------------------------------------------------------------------  ESSAIS NEWS
    public function findBlogMaSelection(string $pageName, array $types = [Contenus::TYPE_BLOG]): array
    {
        return $this->createQueryBuilder('c')
            ->join("c.pages", "p")
            ->andWhere('p.nom = :nom')
            ->andWhere('c.publier = 1')
            ->andWhere('c.type in (:types)')
            ->setParameter('nom', $pageName)
            ->setParameter('types', $types)
            ->orderBy('c.createdAt', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }

// --------------------------------------------------------------------------------------------------------  COMPTEURS

    public function findCompteurs(string $pageName, array $types = [Contenus::TYPE_COMPTEURS]): array
    {
        return $this->createQueryBuilder('c')
            ->join("c.pages", "p")
            ->andWhere('p.nom = :nom')
            ->andWhere('c.publier = 1')
            ->andWhere('c.type in (:types)')
            ->setParameter('nom', $pageName)
            ->setParameter('types', $types)
            ->orderBy('c.createdAt', 'DESC')
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
