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


// -------------------------------------------------------------------------------------------------  Home - All blocks
    public function findByPagesName(string $pageName, int $maxResults = 10): array
    {
        return $this->createQueryBuilder('c')
            ->join("c.pages", "p")
            ->andWhere('LOWER(p.nom) = :nom')
            ->andWhere('c.publier = 1')
            ->setParameter('nom', strtolower($pageName))
            ->orderBy('c.createdAt', 'DESC')
            ->setMaxResults($maxResults)
            ->getQuery()
            ->getResult();
    }

    public function findByType(array $types = [], int $maxResults = 10): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.publier = 1')
            ->andWhere('c.type in (:types)')
            ->setParameter('types', $types)
            ->orderBy('c.createdAt', 'DESC')
            ->setMaxResults($maxResults)
            ->getQuery()
            ->getResult();
    }

// --------------------------------------------------------------------------------------------------------  COMPTEURS

    public function findByPageNameAndTypes(string $pageName, array $types = [], int $maxResults = 10): array
    {
        return $this->createQueryBuilder('c')
            ->join("c.pages", "p")
            ->andWhere('LOWER(p.nom) = :nom')
            ->andWhere('c.publier = 1')
            ->andWhere('c.type in (:types)')
            ->setParameter('nom', strtolower($pageName))
            ->setParameter('types', $types)
            ->orderBy('c.createdAt', 'DESC')
            ->setMaxResults($maxResults)
            ->getQuery()
            ->getResult();
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
