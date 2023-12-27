<?php

namespace App\Service;



use App\Entity\Documents;
use App\Entity\User;
use App\Repository\DocumentsRepository;


class documentsFinder
{
    private ?Documents $documents;
    private DocumentsRepository $documentsRepository;


    public function __construct(DocumentsRepository $documentsRepository, User $user, $id)
    {
//
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//
//
////        $user = $this->getUser();
////        if ($artisan !== $user->getArtisan()) {
////            throw $this->createAccessDeniedException("Vous n'êtes pas encore enregistré");
////        }
//
//        $this->DocumentsRepository = $documentsRepository;
//        $this->mise_en_copie = $this->DocumentsRepository->find(1);
//    }


    }
}