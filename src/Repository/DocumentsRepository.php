<?php

namespace App\Repository;

use App\Entity\Documents;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Documents>
 *
 * @method Documents|null find($id, $lockMode = null, $lockVersion = null)
 * @method Documents|null findOneBy(array $criteria, array $orderBy = null)
 * @method Documents[]    findAll()
 * @method Documents[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocumentsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Documents::class);
    }

    /**
     * @return Documents[] Returns an array of Documents objects
     */


    public function findDocumentArtisan($idArtisan): array
    {
        $qb = $this->createQueryBuilder('d');

        $qb->select('d')
//            ->from('App:Documents', 'd')
            ->innerJoin('App:Projet', 'p', 'WITH', 'p.id=d.projet')
            ->innerJoin('App:Tache', 't', 'WITH', 't.projet = p.id')
            ->where('t.artisan = :idArtisan')
            ->setParameter('idArtisan', $idArtisan);
        $result = $qb->getQuery()->getResult();
        return $result;

    }

    public function findDocumentClient($idClient): array
    {
        $qb = $this->createQueryBuilder('d');
        $qb->select('d')
//            ->from('App:Documents', 'd')
            ->innerJoin('App:Projet', 'p', 'WITH', 'p.id=d.projet')
            ->innerJoin('App:Client', 'c', 'WITH', 'c.id = p.id')
            ->where('p.id = :idClient')
            ->setParameter('idClient', $idClient);
        $result = $qb->getQuery()->getResult();
        return $result;

    }
//    public function findById($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Documents
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
