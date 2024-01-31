<?php

namespace App\Service;



use App\Repository\ContactFormRepository;

class countMsg
{

    private ?ContactFormRepository $contactForm;


    public function __construct(ContactFormRepository $contactForm)
    {
        $msg = $this->contact = $contactForm;

        $resultMsg = $msg->createQueryBuilder('c')
            ->select('COUNT(c.nom)')
            ->where('c.nom = :nom')
            ->setParameter('nom', 'grandemanche')
            ->getQuery()
            ->getResult();
//            ->getOneOrNullResult();

//            ->getSingleScalarResult();
        $this->resultMsg = $resultMsg[0];
    }
        public function __toString(): string
    {

        return strval($this->resultMsg[1]);
    }


//    public function msgNonLu(): ContactFormRepository
//    {
//
//
//
//        return $this-> $msg;
//    }

}