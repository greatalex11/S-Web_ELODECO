<?php

namespace App\Repository;

use App\Entity\Peripheriques;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

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
    private mixed $session;

    public function __construct(ManagerRegistry $registry, ParameterBagInterface $params, )
    {
        parent::__construct($registry, Peripheriques::class);
        $this->params = $params;

    }


    /**
     * @return Peripheriques[] Returns an array of Peripheriques objects
     */

//    public function trouveBidule()
//    {
//        $queryBuilder = $this->createQueryBuilder('periph')
//            ->select('periph.couleur_actuelle_bg');
//
//        $query = $queryBuilder->getQuery();
//        $myResultat = $query->getResult();
//
////     getSingleScalarResult();       $this->params->set('app.colors.my_color', $myResultat);
////        $this->session->set('my_color', $myResultat);
//
//        return $myResultat;
//    }


    public function periphColor():string
    {
//        $colorBg = null;
        $result= $this->createQueryBuilder('periph')
            ->select('periph.couleur_actuelle_bg')
            ->where('periph.id=1')
//            ->where('periph.couleur_actuelle_bg = :coulorBg')
//            ->setParameter('coulorBg', $colorBg)
            ->getQuery()
            ->getOneOrNullResult();


        $this ->params->set('app.colors', $result['couleur_actuelle_bg']);

//        if ($colorBg === null) {
//            return $this->periphColor($params);

//        dd($result);
        return $result;
    }











}

//public function periphColor(string $couleur, string $colorBg, ParameterBagInterface $params): string
//{
//    $this->createQueryBuilder('periph')
//        ->Where('periph.couleur_actuelle_bg = :couleurBg')
//        ->setParameter('couleurBg', $colorBg)
//        ->getQuery()
//        ->getResult();
//
//    $params->set('app.colors.colorBg', $colorBg);
//
//    return $colorBg;
//}

















//            ->getQuery()
//            ->getResult()
//           return $periph;
//        createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()




//    public function findOneBySomeField($value): ?Peripheriques
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }


