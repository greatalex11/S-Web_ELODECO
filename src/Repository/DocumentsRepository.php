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

    //Version 1 : plus complete sur les jointures que la version 2
    public function findDocumentArtisan($idArtisan): array
    {
        $qb = $this->createQueryBuilder('d');

        $qb->select('d');
        $qb->innerJoin('App:Projet', 'p', 'WITH', 'd.projet = p.id')
            ->innerJoin('App:Tache', 't', 'WITH', 't.projet = p.id')
            ->innerJoin('App:Artisan', 'a', 'WITH', 't.artisan = a.id')
            ->where('a.id = :idArtisan')
            ->setParameter('idArtisan', $idArtisan);
        $result = $qb->getQuery()->getResult();
        return $result;

    }

    //Version 2
    //    public function findDocumentArtisan($idArtisan): array
    //    {
    //        $qb = $this->createQueryBuilder('d');
    //
    //        $qb->select('d')
    //            ->join('d.projet', 'p')
    //            ->join('p.taches', 't')
    //            ->join('t.artisan', 'a')
    //            ->where('a.id = :artisanId')
    //            ->setParameter('artisanId', $idArtisan);
    //
    //        $result = $qb->getQuery()->getResult();
    //        return $result;
    //
    //    }


    public function findDocumentClient($idClient): array
    {
        $qb = $this->createQueryBuilder('d')
            ->join('d.projet', 'p')
            ->join('p.client', 'c') // Supposant que 'clients' est le nom de la propriété dans l'entité Projet représentant la relation ManyToMany avec Client
            ->where('c.id = :clientId')
            ->setParameter('clientId', $idClient);

        $result = $qb->getQuery()->getResult();
        return $result;

    }

}
