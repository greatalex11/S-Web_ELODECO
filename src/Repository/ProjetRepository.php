<?php

namespace App\Repository;

use App\Entity\Artisan;
use App\Entity\Documents;
use App\Entity\Projet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\Expr\Select;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Projet>
 *
 * @method Projet|null find($id, $lockMode = null, $lockVersion = null)
 * @method Projet|null findOneBy(array $criteria, array $orderBy = null)
 * @method Projet[]    findAll()
 * @method Projet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Projet::class);

    }

// recherche de document
    public function findProjetByNomClient(?string $idArtisan): array
    {
        $qb = $this->createQueryBuilder('p');
        $qb->select('p')
            ->innerJoin('App:Tache', 't', 'WITH', 't.projet=p.id')
            ->innerJoin('App:Artisan', 'a', 'WITH', 'a.id=t.artisan')
            ->where('a.id = :artisanId')
            ->setParameter('artisanId', $idArtisan);
        $result = $qb->getQuery()->getResult();
        return $result;
    }


    /**
     * @return Projet[] Returns an array of Projet objects
     */
    public function findPjtByIdPjt($idProjet): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.id = :val')
            ->setParameter('val', $idProjet)
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }

//    public function findOneBySomeField($value): ?Projet
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
