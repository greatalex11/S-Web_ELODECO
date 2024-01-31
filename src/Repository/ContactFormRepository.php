<?php

namespace App\Repository;

use App\Entity\ContactForm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Constraints\Count;

/**
 * @extends ServiceEntityRepository<ContactForm>
 *
 * @method ContactForm|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContactForm|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContactForm[]    findAll()
 * @method ContactForm[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactFormRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContactForm::class);
    }




    /**
     * @return ContactForm[] Returns an array of ContactForm objects
     */
    public function countMsg():?string
    {
        return $this->createQueryBuilder('c')
            ->select('COUNT(c.nom)')
            ->where('c.nom = :nom')
            ->setParameter('nom', 'grandemanche')
            ->getQuery()
            ->getResult();
//            ->getOneOrNullResult();

//            ->getSingleScalarResult();
    }

//    public function findOneBySomeField($value): ?ContactForm
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
