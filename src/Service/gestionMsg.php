<?php

namespace App\Service;



use App\Repository\ContactFormRepository;

class gestionMsg
{

    private ?ContactFormRepository $contactForm;


    public function __construct(ContactFormRepository $contactForm)
    {
        $msg = $this->contact = $contactForm;

        $resultMsg = $msg->createQueryBuilder('c')
            ->select('c.msgLu', 'c.status')
            ->where('c.msgLu = :msgLu')
            ->andWhere('c.status=:status')
            ->setParameter('msgLu', '1')
            ->setParameter('status', 'urgent')
            ->getQuery()
            ->getResult();
        $this->resultMsg = $resultMsg;
    }
//        public function __toString(): string
//    {
//
//        return strval($this->resultMsg[1]);
//    }
}