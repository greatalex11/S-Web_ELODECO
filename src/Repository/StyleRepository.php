<?php

namespace App\Repository;

use App\Entity\Style;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Style>
 *
 * @method Style|null find($id, $lockMode = null, $lockVersion = null)
 * @method Style|null findOneBy(array $criteria, array $orderBy = null)
 * @method Style[]    findAll()
 * @method Style[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StyleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Style::class);
    }

    /**
     * @return Style[] Returns an array of Style objects
     */
//    public function findByPagesName(string $pageName, int $maxResults = 25): array
//    {
//        return $this->createQueryBuilder('s')
//            ->join("s.page", "p")
////            ->andWhere('LOWER(p.nom) = :nom')
////            ->andWhere('s.publier = 1')
//            ->setParameter('nom', strtolower($pageName))
////            ->orderBy('c.createdAt', 'DESC')
//            ->setMaxResults($maxResults)
//            ->getQuery()
//            ->getResult();
//    }

//    public function findOneBySomeField($value): ?Style
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
